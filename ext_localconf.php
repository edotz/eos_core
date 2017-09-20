<?php
if (! defined ( 'TYPO3_MODE' )) {
    die ( 'Access denied.' );
}

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
