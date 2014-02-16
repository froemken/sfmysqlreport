<?php
namespace StefanFroemken\Sfmysqlreport\Report;

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
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The mysql status report
 */
class MySql implements \TYPO3\CMS\Reports\ReportInterface {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\CMS\Fluid\View\StandaloneView
	 */
	protected $view;





	/**
	 * as long as this class was NOT called over ObjectManager we have to implement properties on our own
	 */
	public function __construct() {
		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->view = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$this->view->setTemplatePathAndFilename(ExtensionManagementUtility::extPath('sfmysqlreport') . 'Resources/Private/Templates/Reports/List.html');
		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
		$pageRenderer = $objectManager->get('TYPO3\\CMS\\Core\\Page\\PageRenderer');
		$pageRenderer->addCssFile(ExtensionManagementUtility::extRelPath('sfmysqlreport') . 'Resources/Public/Css/Main.css');
		$this->objectManager = $objectManager;
	}

	/**
	 * Takes care of creating / rendering the mysql status report
	 *
	 * @return	string	The status report as HTML
	 */
	public function getReport() {
		$reports = array();
		$availableReports = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sfmysqlreport']['reports'];
		if (is_array($availableReports) && count($availableReports)) {
			foreach ($availableReports as $availableReport) {
				if (class_exists($availableReport)) {
					/** @var \StefanFroemken\Sfmysqlreport\Reports\ReportInterface $report */
					$availableReportObject = $this->objectManager->get($availableReport);
					if ($availableReportObject instanceof \StefanFroemken\Sfmysqlreport\Reports\ReportInterface) {
						$report = $availableReportObject->getReport();
						if ($report instanceof \StefanFroemken\Sfmysqlreport\Domain\Model\Report) {
							$reports[] = $report;
						}
					}
				}
			}
		}
		$this->view->assign('reports', $reports);
		return $this->view->render();
	}

	/**
	 * Call this method to generate the global mysql variables var as key/value pairs
	 */
	public function setTableInformations() {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('
			TABLE_NAME, table_rows, data_length, index_length',
			'information_schema.TABLES',
			'table_schema = "' . TYPO3_db . '"
		');
		$this->tableInformations = $rows;
	}


	/**
	 * getter for table informations
	 *
	 * @return array
	 */
	public function getTableInformations() {
		return $this->tableInformations;
	}


	/**
	 * Call this method to generate a list of all columns
	 */
	public function setColumns() {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'*',
			'information_schema.COLUMNS',
			'TABLE_SCHEMA = "' . TYPO3_db . '"
		');
		$this->columns = $rows;
	}


	/**
	 * getter for table columns
	 *
	 * @return array
	 */
	public function getColumns() {
		return $this->columns;
	}
}