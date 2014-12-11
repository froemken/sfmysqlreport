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
class QueryCacheViewHelper extends AbstractViewHelper {

	/**
	 * analyze QueryCache parameters
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables
	 * @return string
	 */
	public function render(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status, \StefanFroemken\Sfmysqlreport\Domain\Model\Variables $variables) {
		$this->templateVariableContainer->add('hitRatio', $this->getHitRatio($status));
		$this->templateVariableContainer->add('insertRatio', $this->getInsertRatio($status));
		$this->templateVariableContainer->add('pruneRatio', $this->getPruneRatio($status));
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove('hitRatio');
		$this->templateVariableContainer->remove('insertRatio');
		$this->templateVariableContainer->remove('pruneRatio');
		return $content;
	}

	/**
	 * get hit ratio of query cache
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return float
	 */
	protected function getHitRatio(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$hitRatio = ($status->getQcacheHits() / ($status->getQcacheHits() + $status->getComSelect())) * 100;
		return round($hitRatio, 2) . '%';
	}

	/**
	 * get insert ratio of query cache
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return float
	 */
	protected function getInsertRatio(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$insertRatio = ($status->getQcacheInserts() / ($status->getQcacheHits() + $status->getComSelect())) * 100;
		return round($insertRatio, 2) . '%';
	}

	/**
	 * get prune ratio of query cache
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Model\Status $status
	 * @return float
	 */
	protected function getPruneRatio(\StefanFroemken\Sfmysqlreport\Domain\Model\Status $status) {
		$pruneRatio = ($status->getQcacheLowmemPrunes() / $status->getQcacheInserts()) * 100;
		return round($pruneRatio, 2) . '%';
	}

}