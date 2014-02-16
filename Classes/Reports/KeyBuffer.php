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
class KeyBuffer extends \StefanFroemken\Sfmysqlreport\Reports\AbstractReport {

	protected $title = 'KeyBuffer';

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
		$cacheHitRate = 100 - ( ( $this->status->getKeyReads() * 100 ) / $this->status->getKeyReadRequests() );
		$this->addCalculation(
			$report,
			'cacheHitRatioBook.title',
			$cacheHitRate,
			'cacheHitRatioBook.description',
			95, 100
		);
		$cacheHitRate = ( $this->status->getKeyReads() / $this->status->getKeyReadRequests() );
		$this->addCalculation(
			$report,
			'cacheHitRatioMySql.title',
			$cacheHitRate,
			'cacheHitRatioMySql.description',
			0, 0.01
		);
		$cacheHitRate = ( $this->status->getKeyReadRequests() / $this->status->getKeyReads() );
		$this->addCalculation(
			$report,
			'cacheHitRatio.title',
			$cacheHitRate,
			'cacheHitRatio.description',
			100, 1000000
		);
		$cacheMisses = ( $this->status->getKeyReads() / $this->status->getUptime() );
		$this->addCalculation(
			$report,
			'cacheMisses.title',
			$cacheMisses,
			'cacheMisses.description',
			0, 15
		);
		$usedBuffer = 100 - ( ( $this->status->getKeyBlocksUnused() * $this->variables->getKeyCacheBlockSize() ) * 100 / $this->variables->getKeyBufferSize() );
		$this->addCalculation(
			$report,
			'usedBuffer.title',
			$usedBuffer,
			'usedBuffer.description',
			0, 90
		);
		$indexSize = $this->tableInformationRepository->getIndexSize(\StefanFroemken\Sfmysqlreport\Domain\Repository\TableInformationRepository::MYISAM);
		$this->addCalculation(
			$report,
			'myIsamIndexSize.title',
			$this->formatSize($indexSize),
			'myIsamIndexSize.description',
			0, ($this->variables->getKeyBufferSize() - ($this->variables->getKeyBufferSize() / 100 * 10))
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
		$report->addVariable('key_buffer_size', $this->formatSize($this->variables->getKeyBufferSize()));
		$report->addVariable('key_cache_block_size', $this->formatSize($this->variables->getKeyCacheBlockSize()));
	}

	/**
	 * add important status
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @return void
	 */
	protected function addImportantStatus(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report) {
		$report->addStatus('Key_blocks_unused', $this->status->getKeyBlocksUnused());
		$report->addStatus('Key_Read_Requests', $this->status->getKeyReadRequests());
		$report->addStatus('Key_Reads', $this->status->getKeyReads());
	}

}