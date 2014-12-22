<?php
namespace StefanFroemken\Sfmysqlreport\Backend;

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
use TYPO3\CMS\Backend\Toolbar\ClearCacheActionsHookInterface;
use TYPO3\CMS\Backend\Utility\IconUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CacheAction implements ClearCacheActionsHookInterface {

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection = NULL;

	/**
	 * constructor of this class
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Modifies CacheMenuItems array
	 *
	 * @param array $cacheActions Array of CacheMenuItems
	 * @param array $optionValues Array of AccessConfigurations-identifiers (typically  used by userTS with options.clearCache.identifier)
	 * @return void
	 */
	public function manipulateCacheActions(&$cacheActions, &$optionValues) {
		$cacheActions[] = array(
			'id' => 'mysqlprofiles',
			'title' => 'Clear MySQL Profiles',
			'description' => 'Clear collected profile records of extension sfmysqlreport. This table can grow very fast, so maybe it is good to clear this table.',
			'href' => 'tce_db.php?vC=' . $this->getBackendUser()->veriCode() . '&cacheCmd=mysqlprofiles&ajaxCall=1' . BackendUtility::getUrlToken('tceAction'),
			'icon' => IconUtility::getSpriteIcon('actions-system-cache-clear-impact-high')
		);
		$optionValues[] = 'mysqlprofiles';
	}

	/**
	 * Returns the current BE user.
	 *
	 * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
	 */
	protected function getBackendUser() {
		return $GLOBALS['BE_USER'];
	}

	/**
	 * truncate table tx_sfmysqlreport_domain_model_profile
	 *
	 * @param array $params
	 * @return void
	 */
	public function clearProfiles($params = array()) {
		if ($params['cacheCmd'] === 'mysqlprofiles') {
			$this->databaseConnection->exec_TRUNCATEquery('tx_sfmysqlreport_domain_model_profile');
		}
	}

}