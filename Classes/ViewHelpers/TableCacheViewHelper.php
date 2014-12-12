<?php
namespace StefanFroemken\Sfmysqlreport\ViewHelpers;

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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TableCacheViewHelper extends AbstractViewHelper {

	/**
	 * analyze QueryCache parameters
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables
	 * @return string
	 */
	public function render(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status, \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables) {
		$this->templateVariableContainer->add('openedTableDefsEachSecond', $this->getOpenedTableDefinitionsEachSecond($status));
		$this->templateVariableContainer->add('openedTablesEachSecond', $this->getOpenedTablesEachSecond($status));
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove('openedTableDefsEachSecond');
		$this->templateVariableContainer->remove('openedTablesEachSecond');
		return $content;
	}

	/**
	 * get amount of opened table definitions each second
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return array
	 */
	protected function getOpenedTableDefinitionsEachSecond(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$result = array();
		$openedTableDefinitions = $status->getOpenedTableDefinitions() / $status->getUptime();
		if ($openedTableDefinitions <= 0.3) {
			$result['status'] = 'success';
		} elseif ($openedTableDefinitions <= 2) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'danger';
		}
		$result['value'] = round($openedTableDefinitions, 4);
		return $result;
	}

	/**
	 * get amount of opened tables each second
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return array
	 */
	protected function getOpenedTablesEachSecond(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$result = array();
		$openedTables = $status->getOpenedTables() / $status->getUptime();
		if ($openedTables <= 0.6) {
			$result['status'] = 'success';
		} elseif ($openedTables <= 4) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'danger';
		}
		$result['value'] = round($openedTables, 4);
		return $result;
	}

}