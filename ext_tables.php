<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Edotz Core');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('eos_core', 'Content');

$configurationService = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Edotz\EosCore\Service\ConfigurationService');
$configurationService->setTypoScriptFromTemplateFields();