<?php
namespace StefanFroemken\Sfmysqlreport\Reports;

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
 * Analyse key_buffer
 */
class SortBuffer extends \StefanFroemken\Sfmysqlreport\Reports\AbstractReport {

	protected $title = 'SortBuffer';

	/**
	 * return report to MySqlReport class
	 *
	 * @return \StefanFroemken\Sfmysqlreport\Domain\Model\Report
	 */
	public function getReport() {
		/** @var \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report */
		$report = $this->objectManager->get('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\Report');
		$report->setTitle($this->title);
		$this->addImportantVariables($report);
		$this->addImportantStatus($report);

		// add calculation
		$diffTableDefinitions = $this->variables->getTableDefinitionCache() - $this->status->getOpenTableDefinitions();
		$this->addCalculation($report, 'Diff open table definitions', $diffTableDefinitions, 'Persönlich: Alles was größer ist als 10 ist völlig in Ordnung.');
		$diffTable = $this->variables->getTableOpenCache() - $this->status->getOpenTables();
		$this->addCalculation($report, 'Diff open tables', $diffTable, 'Persönlich: Alles was größer ist als 10 ist völlig in Ordnung.');
		$openedDefsEachSec = $this->status->getOpenedTableDefinitions() / $this->status->getUptime();
		$this->addCalculation($report, 'Geöffnete Tabellen Definitionen pro Sekunde', $openedDefsEachSec, '0-3 ist OK. Alles über 10 benötigt Handlungsbedarf.');
		$openedTablesEachSec = $this->status->getOpenedTables() / $this->status->getUptime();
		$this->addCalculation($report, 'Geöffnete Tabellen pro Sekunde', $openedTablesEachSec, '0-3 ist OK. Alles über 10 benötigt Handlungsbedarf.');

		return $report;
	}

	/**
	 * add important variables
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @return void
	 */
	protected function addImportantVariables(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report) {
		$report->addVariable('table_definition_cache', $this->variables->getTableDefinitionCache());
		$report->addVariable('table_open_cache', $this->variables->getTableOpenCache());
	}

	/**
	 * add important status
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @return void
	 */
	protected function addImportantStatus(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report) {
		$report->addStatus('Open_table_definitions', $this->status->getOpenTableDefinitions());
		$report->addStatus('Opened_table_definitions', $this->status->getOpenedTableDefinitions());
		$report->addStatus('Open_tables', $this->status->getOpenTables());
		$report->addStatus('Opened_tables', $this->status->getOpenedTables());
	}

}