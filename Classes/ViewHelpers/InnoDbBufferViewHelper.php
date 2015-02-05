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
use StefanFroemken\Sfmysqlreport\Domain\Model\Status;
use StefanFroemken\Sfmysqlreport\Domain\Model\Variables;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class InnoDbBufferViewHelper extends AbstractViewHelper {

	/**
	 * analyze QueryCache parameters
	 *
	 * @param Status $status
	 * @param Variables $variables
	 * @return string
	 */
	public function render(Status $status, Variables $variables) {
		$this->templateVariableContainer->add('hitRatio', $this->getHitRatio($status));
		$this->templateVariableContainer->add('hitRatioBySF', $this->getHitRatioBySF($status));
		$this->templateVariableContainer->add('writeRatio', $this->getWriteRatio($status));
		$this->templateVariableContainer->add('load', $this->getLoad($status));
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove('hitRatio');
		$this->templateVariableContainer->remove('hitRatioBySF');
		$this->templateVariableContainer->remove('writeRatio');
		$this->templateVariableContainer->remove('load');
		return $content;
	}

	/**
	 * get hit ratio of innoDb Buffer
	 * A ratio of 99.9 equals 1/1000
	 *
	 * @param Status $status
	 * @return array
	 */
	protected function getHitRatio(Status $status) {
		$result = array();
		$hitRatio = ($status->getInnodbBufferPoolReadRequests() / ($status->getInnodbBufferPoolReadRequests() + $status->getInnodbBufferPoolReads())) * 100;
		if ($hitRatio <= 90) {
			$result['status'] = 'danger';
		} elseif ($hitRatio <= 99.7) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'success';
		}
		$result['value'] = round($hitRatio, 2);
		return $result;
	}

	/**
	 * get hit ratio of innoDb Buffer by SF
	 *
	 * @param Status $status
	 * @return array
	 */
	protected function getHitRatioBySF(Status $status) {
		$result = array();

		// we always want a factor of 1/1000.
		$niceToHave = $status->getInnodbBufferPoolReads() * 1000;
		$hitRatio = 100 / $niceToHave * $status->getInnodbBufferPoolReadRequests();
		if ($hitRatio <= 70) {
			$result['status'] = 'danger';
		} elseif ($hitRatio <= 90) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'success';
		}
		$result['value'] = round($hitRatio, 2);
		return $result;
	}

	/**
	 * get write ratio of innoDb Buffer
	 * A value more higher than 1 is good
	 *
	 * @param Status $status
	 * @return array
	 */
	protected function getWriteRatio(Status $status) {
		$result = array();
		$writeRatio = $status->getInnodbBufferPoolWriteRequests() / $status->getInnodbBufferPoolPagesFlushed();
		if ($writeRatio <= 2) {
			$result['status'] = 'danger';
		} elseif ($writeRatio <= 7) {
			$result['status'] = 'warning';
		} else {
			$result['status'] = 'success';
		}
		$result['value'] = round($writeRatio, 2);
		return $result;
	}

	/**
	 * get load of InnoDB Buffer
	 *
	 * @param Status $status
	 * @return array
	 */
	protected function getLoad(Status $status) {
		$load = array();

		// in Bytes
		$total = $status->getInnodbBufferPoolPagesTotal() * $status->getInnodbPageSize();
		$data = $status->getInnodbBufferPoolPagesData() * $status->getInnodbPageSize();
		$misc = $status->getInnodbBufferPoolPagesMisc() * $status->getInnodbPageSize();
		$free = $status->getInnodbBufferPoolPagesFree() * $status->getInnodbPageSize();

		// in MB
		$load['total'] = GeneralUtility::formatSize($total);
		$load['data'] = GeneralUtility::formatSize($data);
		$load['misc'] = GeneralUtility::formatSize($misc);
		$load['free'] = GeneralUtility::formatSize($free);

		// in percent
		$load['dataPercent'] = round(100 / $total * $data, 1);
		$load['miscPercent'] = round(100 / $total * $misc, 1);
		$load['freePercent'] = round(100 / $total * $free, 1);

		return $load;
	}

}