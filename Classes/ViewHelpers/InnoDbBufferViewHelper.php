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
class InnoDbBufferViewHelper extends AbstractViewHelper {

	/**
	 * analyze QueryCache parameters
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables
	 * @return string
	 */
	public function render(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status, \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables) {
		$this->templateVariableContainer->add('hitRatio', $this->getHitRatio($status));
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove('hitRatio');
		return $content;
	}

	/**
	 * get hit ratio of innoDb Buffer
	 * A ratio of 99.9 equals 1/1000
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return array
	 */
	protected function getHitRatio(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$result = array();
		$hitRatio = ($status->getInnodbBufferPoolReadRequests() / ($status->getInnodbBufferPoolReadRequests() + $status->getInnodbBufferPoolReads())) * 100;
		if ($hitRatio <= 99) {
			$result['status'] = 'danger';
		} elseif ($hitRatio <= 99.8) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'success';
		}
		$result['value'] = round($hitRatio, 2);
		return $result;
	}

}