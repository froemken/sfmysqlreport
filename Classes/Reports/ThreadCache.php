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
class ThreadCache extends \StefanFroemken\Sfmysqlreport\Reports\AbstractReport {

	protected $title = 'ThreadCache';

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
		$createdThreadsPerSecond = round( $this->status->getThreadsCreated() / $this->status->getUptime(), 4 );
		$this->addCalculation(
			$report,
			'createdThreadsEachSecond.title',
			$createdThreadsPerSecond,
			'createdThreadsEachSecond.description',
			0, 10
		);
		$createdBytes = 256 * 1024 * $this->status->getThreadsCreated();
		$this->addCalculation(
			$report,
			'sumOfAllThreadsInBytes.title',
			$this->formatSize($createdBytes),
			'sumOfAllThreadsInBytes.description',
			0, (10 * 1024 * 1024 * 1024)
		);

		return $report;
	}

	/**
	 * add important variables
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @return void
	 */
	protected function addImportantVariables(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report) {
		$report->addVariable('thread_cache_size', $this->variables->getThreadCacheSize());
	}

	/**
	 * add important status
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @return void
	 */
	protected function addImportantStatus(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report) {
		$report->addStatus('Threads_connected', $this->status->getThreadsConnected());
		$report->addStatus('Threads_created', $this->status->getThreadsCreated());
	}

}