<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Edotz Core');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('eos_core', 'Content');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Edotz.'. $_EXTKEY,
        'pi1',
        'EosCore: Content'
        );


$configurationService = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Edotz\EosCore\Service\ConfigurationService');
$configurationService->setTypoScriptFromTemplateFields();

$GLOBALS['PAGES_TYPES']['default']['allowedTables'] .= ',tx_eoscore_domain_model_realurl';