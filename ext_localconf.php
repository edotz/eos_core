<?php
if (! defined ( 'TYPO3_MODE' )) {
    die ( 'Access denied.' );
}

if (FALSE === is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['eos_core'])) {
    
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['eos_core'] = array(
        'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\StringFrontend',
        'options' => array(),
        'groups' => array()
    );
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'Edotz\\EosCore\\Hook\\RealUrlDataHook';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Edotz\EosCore\Task\MailLogsTask::class] = array(
        'extension' => $_EXTKEY,
        'title' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.name',
        'description' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.description',
        'additionalFields' => \Edotz\EosCore\Task\MailLogsAdditionalFieldProvider::class
        
);

/**
 * Plugin to show preview sections 
 * of all fluid_content elements
 * found in this extension
 * ,hasi
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin (
    'Edotz.' . $_EXTKEY,
    'pi1',
    array (
            'Content' => 'index'
    ),
    array ()
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
        wizards.newContentElement.wizardItems.groupeos {
            header = LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:newContentElements.tab.eos_content
            show = *
        }
    }'
);

include_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, '/Configuration/RealUrl/Configuration.php');

