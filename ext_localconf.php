<?php
defined('TYPO3_MODE') or die();

$extConf = is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]) ?: unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);

if (
	($extConf['profileFrontend'] && TYPO3_MODE === 'FE') ||
	($extConf['profileBackend'] && TYPO3_MODE === 'BE')
) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['setDBinit'] .= LF . ' SET profiling = 1;';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_db.php']['queryProcessors'][] = 'StefanFroemken\\Sfmysqlreport\\Database\\DatabaseHooks';
}

if (TYPO3_MODE === 'BE') {
	// add button to clear cache of profiling table
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions'][] = 'StefanFroemken\\Sfmysqlreport\\Backend\\CacheAction';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = 'StefanFroemken\\Sfmysqlreport\\Backend\\CacheAction->clearProfiles';
}