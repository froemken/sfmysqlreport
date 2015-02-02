<?php
namespace StefanFroemken\Sfmysqlreport\Domain\Repository;

/***************************************************************
*  Copyright notice
*
*  (c) 2014 Stefan Froemken <froemken@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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

/**
 * This model saves the mysql status
 */
class DatabaseRepository extends AbstractRepository {

	/**
	 * get grouped profilings grouped by unique identifier
	 * and ordered by crdate descending
	 *
	 * @return array
	 */
	public function findProfilingsForCall() {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'crdate, unique_call_identifier, mode, SUM(duration) as duration',
			'tx_sfmysqlreport_domain_model_profile',
			'',
			'unique_call_identifier', 'crdate DESC', 100
		);
	}

	/**
	 * get a grouped version of a profiling
	 *
	 * @param string $uniqueIdentifier
	 * @return array
	 */
	public function getProfilingByUniqueIdentifier($uniqueIdentifier) {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'query_type, unique_call_identifier, SUM(duration) as duration',
			'tx_sfmysqlreport_domain_model_profile',
			'unique_call_identifier = "' . $uniqueIdentifier . '"',
			'query_type', 'duration DESC', ''
		);
	}

	/**
	 * get queries of defined query type
	 *
	 * @param string $uniqueIdentifier
	 * @param string $queryType
	 * @return array
	 */
	public function getProfilingsByQueryType($uniqueIdentifier, $queryType) {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid, LEFT(query, 120) as query, not_using_index, duration',
			'tx_sfmysqlreport_domain_model_profile',
			'unique_call_identifier = "' . $uniqueIdentifier . '"
			AND query_type = "' . $queryType . '"',
			'', 'duration DESC', ''
		);
	}

	/**
	 * get profiling infomations by uid
	 *
	 * @param string $uid
	 * @return array
	 */
	public function getProfilingByUid($uid) {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
			'LEFT(query, 255) as query, query_type, profile, explain_query, not_using_index, duration',
			'tx_sfmysqlreport_domain_model_profile',
			'uid = ' . $uid,
			'', '', ''
		);
	}

	/**
	 * find queries using filesort
	 *
	 * @return array
	 */
	public function findQueriesWithFilesort() {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'LEFT(query, 255) as query, explain_query, duration',
			'tx_sfmysqlreport_domain_model_profile',
			'explain_query LIKE "%using filesort%"',
			'', 'duration DESC', '100'
		);
	}

	/**
	 * find queries using full table scan
	 *
	 * @return array
	 */
	public function findQueriesWithFullTableScan() {
		return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'LEFT(query, 255) as query, explain_query, duration',
			'tx_sfmysqlreport_domain_model_profile',
			'using_fulltable = 1',
			'', 'duration DESC', '100'
		);
	}

}