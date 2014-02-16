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
class TableInformationRepository extends \StefanFroemken\Sfmysqlreport\Domain\Repository\AbstractRepository {

	const INNODB = 'InnoDB';
	const MYISAM = 'MyISAM';

	/**
	 * get table informations from information_scheme
	 *
	 * @return array
	 */
	public function findAll() {
		$rows = array();
		$res = $this->databaseConnection->sql_query('
			SELECT *
			FROM information_schema.TABLES
			WHERE table_schema = "' . TYPO3_db . '";
		');
		while ($row = $this->databaseConnection->sql_fetch_assoc($res)) {
			$rows[$row['TABLE_NAME']] = $this->dataMapper->mapSingleRow('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\TableInformation', $row);
		}
		return $rows;
	}

	/**
	 * get table informations of a given engine from information_scheme
	 *
	 * @param string $engine
	 * @return array
	 */
	public function findAllByEngine($engine) {
		$rows = array();
		$res = $this->databaseConnection->sql_query('
			SELECT *
			FROM information_schema.TABLES
			WHERE table_schema = "' . TYPO3_db . '"
			AND ENGINE = "' . $engine . '";
		');
		while ($row = $this->databaseConnection->sql_fetch_assoc($res)) {
			$rows[$row['TABLE_NAME']] = $this->dataMapper->mapSingleRow('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\TableInformation', $row);
		}
		return $rows;
	}

	/**
	 * get table information of a given table from information_scheme
	 *
	 * @param string $table
	 * @return \StefanFroemken\Sfmysqlreport\Domain\Model\TableInformation
	 */
	public function findByTable($table) {
		$res = $this->databaseConnection->sql_query('
			SELECT *
			FROM information_schema.TABLES
			WHERE table_schema = "' . TYPO3_db . '"
			AND TABLE_NAME = "' . $table . '";
		');
		while ($row = $this->databaseConnection->sql_fetch_assoc($res)) {
			$rows[$row['TABLE_NAME']] = $this->dataMapper->mapSingleRow('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\TableInformation', $row);
		}
		return $rows;
	}

	/**
	 * get indexSize from information_scheme
	 *
	 * @param string $engine
	 * @return array
	 */
	public function getIndexSize($engine = '') {
		$additionalWhere = '';
		if (!empty($engine)) {
			$additionalWhere = ' AND ENGINE = "' . $engine . '"';
		}
		$res = $this->databaseConnection->sql_query('
			SELECT SUM(INDEX_LENGTH) AS indexsize
			FROM information_schema.TABLES
			WHERE table_schema = "' . TYPO3_db . '"' .
			$additionalWhere . ';
		');
		$row = $this->databaseConnection->sql_fetch_assoc($res);
		return $row['indexsize'];
	}

}