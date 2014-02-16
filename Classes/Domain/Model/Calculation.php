<?php
namespace StefanFroemken\Sfmysqlreport\Domain\Model;

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
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Calculation
 */
class Calculation {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * result
	 *
	 * @var string
	 */
	protected $result = '';

	/**
	 * minAllowedValue
	 *
	 * @var int
	 */
	protected $minAllowedValue = 0;

	/**
	 * maxAllowedValue
	 *
	 * @var int
	 */
	protected $maxAllowedValue = 0;





	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		$title = LocalizationUtility::translate($this->title, 'Sfmysqlreport');
		if (empty($title)) {
			$title = $this->title;
		}
		return $title;
	}

	/**
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
		$description = LocalizationUtility::translate($this->description, 'Sfmysqlreport');
		if (empty($description)) {
			$description = $this->description;
		}
		return $description;
	}

	/**
	 * Setter for description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for result
	 *
	 * @return string
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * Setter for result
	 *
	 * @param string $result
	 * @return void
	 */
	public function setResult($result) {
		$this->result = $result;
	}

	/**
	 * Getter for minAllowedValue
	 *
	 * @return int
	 */
	public function getMinAllowedValue() {
		return $this->minAllowedValue;
	}

	/**
	 * Setter for minAllowedValue
	 *
	 * @param int $minAllowedValue
	 * @return void
	 */
	public function setMinAllowedValue($minAllowedValue) {
		$this->minAllowedValue = $minAllowedValue;
	}

	/**
	 * Getter for maxAllowedValue
	 *
	 * @return int
	 */
	public function getMaxAllowedValue() {
		return $this->maxAllowedValue;
	}

	/**
	 * Setter for maxAllowedValue
	 *
	 * @param int $maxAllowedValue
	 * @return void
	 */
	public function setMaxAllowedValue($maxAllowedValue) {
		$this->maxAllowedValue = $maxAllowedValue;
	}

	/**
	 * is value in range
	 *
	 * @return bool
	 */
	public function isInRange() {
		if ($this->result >= $this->minAllowedValue && $this->result <= $this->maxAllowedValue) {
			// everything is OK
			return TRUE;
		} else {
			// value too high or low
			return FALSE;
		}
	}

}