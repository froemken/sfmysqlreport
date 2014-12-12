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
class MySqlController extends ActionController {

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\StatusRepository
	 */
	protected $statusRepository;

	/**
	 * @var \StefanFroemken\Sfmysqlreport\Domain\Repository\VariablesRepository
	 */
	protected $variablesRepository;

	/**
	 * inject statusRepository
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Repository\StatusRepository $statusRepository
	 * @return void
	 */
	public function injectStatusRepository(\StefanFroemken\Sfmysqlreport\Domain\Repository\StatusRepository $statusRepository) {
		$this->statusRepository = $statusRepository;
	}

	/**
	 * inject variablesRepository
	 *
	 * @param \StefanFroemken\Sfmysqlreport\Domain\Repository\VariablesRepository $variablesRepository
	 * @return void
	 */
	public function injectVariablesRepository(\StefanFroemken\Sfmysqlreport\Domain\Repository\VariablesRepository $variablesRepository) {
		$this->variablesRepository = $variablesRepository;
	}

	/**
	 * report action
	 *
	 * @return void
	 */
	public function reportAction() {
		$this->view->assign('status', $this->statusRepository->findAll());
		$this->view->assign('variables', $this->variablesRepository->findAll());
	}

	/**
	 * query cache action
	 *
	 * @return void
	 */
	public function queryCacheAction() {
		$this->view->assign('status', $this->statusRepository->findAll());
		$this->view->assign('variables', $this->variablesRepository->findAll());
	}

	/**
	 * innoDb Buffer action
	 *
	 * @return void
	 */
	public function innoDbBufferAction() {
		$this->view->assign('status', $this->statusRepository->findAll());
		$this->view->assign('variables', $this->variablesRepository->findAll());
	}

	/**
	 * thread cache action
	 *
	 * @return void
	 */
	public function threadCacheAction() {
		$this->view->assign('status', $this->statusRepository->findAll());
		$this->view->assign('variables', $this->variablesRepository->findAll());
	}

	/**
	 * table cache action
	 *
	 * @return void
	 */
	public function tableCacheAction() {
		$this->view->assign('status', $this->statusRepository->findAll());
		$this->view->assign('variables', $this->variablesRepository->findAll());
	}

}