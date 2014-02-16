<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	// create a new report
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_sfmysqlreport']['mysqlreport'] = array(
		'title'       => 'LLL:EXT:sfmysqlreport/Resources/Private/Language/locallang.xml:report_title',
		'description' => 'LLL:EXT:sfmysqlreport/Resources/Private/Language/locallang.xml:report_description',
		'report'      => 'StefanFroemken\\Sfmysqlreport\\Report\\MySql',
		'icon'        => 'EXT:sfmysqlreport/reports/tx_myext_report.gif'
	);

	// register the entries
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sfmysqlreport']['reports'][] = 'StefanFroemken\\Sfmysqlreport\\Reports\\ThreadCache';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sfmysqlreport']['reports'][] = 'StefanFroemken\\Sfmysqlreport\\Reports\\KeyBuffer';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sfmysqlreport']['reports'][] = 'StefanFroemken\\Sfmysqlreport\\Reports\\TableCache';
}