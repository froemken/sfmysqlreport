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

/**
 * This model saves the mysql status
 */
class Report {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * status
	 *
	 * @var array
	 */
	protected $status = array();

	/**
	 * variables
	 *
	 * @var array
	 */
	protected $variables = array();

	/**
	 * calculations
	 *
	 * @var array
	 */
	protected $calculations = array();







	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
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
	 * Getter for status
	 *
	 * @return array
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Setter for status
	 *
	 * @param array $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Adds a status
	 *
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function addStatus($key, $value) {
		$this->status[$key] = $value;
	}

	/**
	 * Getter for variables
	 *
	 * @return array
	 */
	public function getVariables() {
		return $this->variables;
	}

	/**
	 * Setter for variables
	 *
	 * @param array $variables
	 * @return void
	 */
	public function setVariables($variables) {
		$this->variables = $variables;
	}

	/**
	 * Adds a variable
	 *
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function addVariable($key, $value) {
		$this->variables[$key] = $value;
	}

	/**
	 * Getter for calculations
	 *
	 * @return array
	 */
	public function getCalculations() {
		return $this->calculations;
	}

	/**
	 * Setter for calculations
	 *
	 * @param array $calculations
	 * @return void
	 */
	public function setCalculations($calculations) {
		$this->calculations = $calculations;
	}

	/**
	 * Adds a calculation
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Calculation $calculation
	 * @return void
	 */
	public function addCalculation(\StefanFroemken\Sfmysqlreport\Domain\Model\Calculation $calculation) {
		$this->calculations[] = $calculation;
	}

}