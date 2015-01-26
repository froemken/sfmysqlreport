<?php
namespace StefanFroemken\Sfmysqlreport\Controller;

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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class QueryController extends ActionController {

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\DatabaseRepository
	 */
	protected $databaseRepository;

	/**
	 * inject databaseRepository
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Repository\DatabaseRepository $databaseRepository
	 * @return void
	 */
	public function injectDatabaseRepository(\StefanFroemken\Sfmysqlreport\Domain\Repository\DatabaseRepository $databaseRepository) {
		$this->databaseRepository = $databaseRepository;
	}

	/**
	 * filesort action
	 *
	 * @return void
	 */
	public function filesortAction() {
		$this->view->assign('queries', $this->databaseRepository->findQueriesWithFilesort());
	}

	/**
	 * using full table scan action
	 *
	 * @return void
	 */
	public function fullTableScanAction() {
		$this->view->assign('queries', $this->databaseRepository->findQueriesWithFullTableScan());
	}

}