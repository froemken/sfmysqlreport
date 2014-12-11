<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'StefanFroemken.' . $_EXTKEY,
		'web',	// Make module a submodule of 'web'
		'mysql',	// Submodule key
		'',	// Position
		array(
			'MySql' => 'report',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_report.xlf',
		)
	);

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