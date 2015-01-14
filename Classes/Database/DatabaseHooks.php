<?php
namespace StefanFroemken\Sfmysqlreport\Database;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stefan Froemken <froemken@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Database\PostProcessQueryHookInterface;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class DatabaseHooks implements PostProcessQueryHookInterface, SingletonInterface {

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection = NULL;

	/**
	 * save profiles
	 *
	 * @var array
	 */
	protected $profiles = array();

	/**
	 * constructor of this class
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * destructor of this class
	 */
	public function __destruct() {
		// A page can be called multiple times each second. So we need a unique identifier.
		$uniqueIdentifier = uniqid('', TRUE);
		// save tstamp of page generation
		$crdate = (int)$GLOBALS['EXEC_TIME'];

		// extend profiles array
		foreach ($this->profiles as $key => $profile) {
			$profile['unique_call_identifier'] = $uniqueIdentifier;
			$profile['crdate'] = $crdate;
			$this->profiles[$key] = $profile;
		}

		// we done want to add followinf INSERT query to profiling table
		$this->databaseConnection->sql_query('SET profiling = 0;');

		// save profilings to database
		if (!empty($this->profiles)) {
			$this->databaseConnection->exec_INSERTmultipleRows(
				'tx_sfmysqlreport_domain_model_profile',
				array('query_id', 'duration', 'query', 'pid', 'mode', 'query_type', 'profile', 'unique_call_identifier', 'crdate'),
				$this->profiles
			);
		}
	}

	/**
	 * Post-processor for the SELECTquery method.
	 *
	 * @param string $select_fields Fields to be selected
	 * @param string $from_table Table to select data from
	 * @param string $where_clause Where clause
	 * @param string $groupBy Group by statement
	 * @param string $orderBy Order by statement
	 * @param int $limit Database return limit
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_SELECTquery_postProcessAction(&$select_fields, &$from_table, &$where_clause, &$groupBy, &$orderBy, &$limit, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {
		$profiles = $this->databaseConnection->sql_query('SHOW PROFILES');
		$uniqueIdentifier = uniqid('', TRUE);
		$crdate = (int)$GLOBALS['EXEC_TIME'];
		// $row: 1:Duration, 2:Query, 3:Query_ID
		while ($row = $this->databaseConnection->sql_fetch_assoc($profiles)) {
			if (!array_key_exists((int)$row['Query_ID'], $this->profiles)) {
				// add page id if possible
				$row['pid'] = is_object($GLOBALS['TSFE']) ? $GLOBALS['TSFE']->id : 0;
				// Save mode: BE or FE
				$row['mode'] = (string)TYPO3_MODE;
				// Save kind of query SELECT/INSERT/DELETE...
				$parts = GeneralUtility::trimExplode(' ', $row['Query'], TRUE, 2);
				$row['query_type'] = $parts[0];
				// save profiling informations of query
				$showProfile = $this->databaseConnection->sql_query('SHOW PROFILE FOR QUERY ' . (int)$row['Query_ID']);
				$profile = array();
				while ($profileRow = $this->databaseConnection->sql_fetch_assoc($showProfile)) {
					$profile[] = $profileRow;
				}
				$row['profile'] = serialize($profile);
				// save collected data temporary
				$this->profiles[(int)$row['Query_ID']] = $row;
			}
		}
	}

	/**
	 * Post-processor for the exec_INSERTquery method.
	 *
	 * @param string $table Database table name
	 * @param array $fieldsValues Field values as key => value pairs
	 * @param string|array $noQuoteFields List/array of keys NOT to quote
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_INSERTquery_postProcessAction(&$table, array &$fieldsValues, &$noQuoteFields, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {

	}

	/**
	 * Post-processor for the exec_INSERTmultipleRows method.
	 *
	 * @param string $table Database table name
	 * @param array $fields Field names
	 * @param array $rows Table rows
	 * @param string|array $noQuoteFields List/array of keys NOT to quote
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_INSERTmultipleRows_postProcessAction(&$table, array &$fields, array &$rows, &$noQuoteFields, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {

	}

	/**
	 * Post-processor for the exec_UPDATEquery method.
	 *
	 * @param string $table Database table name
	 * @param string $where WHERE clause
	 * @param array $fieldsValues Field values as key => value pairs
	 * @param string|array $noQuoteFields List/array of keys NOT to quote
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_UPDATEquery_postProcessAction(&$table, &$where, array &$fieldsValues, &$noQuoteFields, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {

	}

	/**
	 * Post-processor for the exec_DELETEquery method.
	 *
	 * @param string $table Database table name
	 * @param string $where WHERE clause
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_DELETEquery_postProcessAction(&$table, &$where, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {

	}

	/**
	 * Post-processor for the exec_TRUNCATEquery method.
	 *
	 * @param string $table Database table name
	 * @param \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject
	 * @return void
	 */
	public function exec_TRUNCATEquery_postProcessAction(&$table, \TYPO3\CMS\Core\Database\DatabaseConnection $parentObject) {

	}

}