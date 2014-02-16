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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Analyse key_buffer
 */
abstract class AbstractReport implements \StefanFroemken\Sfmysqlreport\Reports\ReportInterface {

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\StatusRepository
	 * @inject
	 */
	protected $statusRepository;

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\VariablesRepository
	 * @inject
	 */
	protected $variablesRepository;

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\TableInformationRepository
	 * @inject
	 */
	protected $tableInformationRepository;

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Model\Status
	 */
	protected $status;

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Model\Variables
	 */
	protected $variables;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager;

	/**
	 * initializes this object
	 * fill status and variables
	 */
	public function initializeObject() {
		$this->variables = $this->variablesRepository->findAll();
		$this->status = $this->statusRepository->findAll();
	}

	/**
	 * add calculation
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Report $report
	 * @param string $title
	 * @param string $result
	 * @param string $description
	 * @param int $minAllowedValue
	 * @param int $maxAllowedValue
	 * @return void
	 */
	protected function addCalculation(\StefanFroemken\Sfmysqlreport\Domain\Model\Report $report, $title, $result, $description, $minAllowedValue, $maxAllowedValue) {
		/** @var \StefanFroemken\Sfmysqlreport\Domain\Model\Calculation $calculation */
		$calculation = $this->objectManager->get('StefanFroemken\\Sfmysqlreport\\Domain\\Model\\Calculation');
		$calculation->setTitle($title);
		$calculation->setDescription($description);
		$calculation->setMinAllowedValue($minAllowedValue);
		$calculation->setMaxAllowedValue($maxAllowedValue);
		$calculation->setResult($result);
		$report->addCalculation($calculation);
	}

	/**
	 * format bytes
	 *
	 * @param $sizeInByte
	 * @return string
	 */
	public function formatSize($sizeInByte) {
		return GeneralUtility::formatSize($sizeInByte, $labels = ' Byte | KB | MB | GB');
	}

}
