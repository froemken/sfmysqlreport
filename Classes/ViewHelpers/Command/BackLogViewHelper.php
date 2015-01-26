<?php
namespace StefanFroemken\Sfmysqlreport\ViewHelpers\Command;

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
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @package sfmysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class BackLogViewHelper extends AbstractViewHelper {

	/**
	 * execute a shell command to get the
	 *
	 * @link: http://dev.mysql.com/doc/refman/5.6/en/server-system-variables.html#sysvar_back_log
	 * @link: http://forums.gentoo.org/viewtopic-p-7374046.html#7374046
	 * @return string
	 */
	public function render() {
		$value = '';
		$command = CommandUtility::getCommand('sysctl');
		$lastLine = CommandUtility::exec($command . ' net.core.somaxconn');
		if (empty($lastLine)) {
			// maybe we are on a MAC
			$lastLine = CommandUtility::exec($command . ' kern.ipc.somaxconn');
		}
		if (!empty($lastLine)) {
			$parts = GeneralUtility::trimExplode(':', $lastLine);
			$value = $parts[1];
		}
		return $value;
	}

}