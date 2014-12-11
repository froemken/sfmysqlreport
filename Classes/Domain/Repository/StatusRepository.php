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
class StatusRepository extends AbstractRepository {

	/**
	 * get status from MySql
	 *
	 * @return \StefanFroemken\Sfmysqlreport\Domain\Model\Status
	 */
	public function findAll() {
		$rows = array();
		$res = $this->databaseConnection->sql_query('SHOW GLOBAL STATUS;');
		while ($row = $this->databaseConnection->sql_fetch_assoc($res)) {
			$rows[strtolower($row['Variable_name'])] = $row['Value'];
		}
		return $this->dataMapper->mapSingleRow('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\Status', $rows);
	}

}