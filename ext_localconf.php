<?php
if (! defined ( 'TYPO3_MODE' )) {
    die ( 'Access denied.' );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin (
    'Edotz.' . $_EXTKEY,
    'pi1',
    array (
            'Content' => 'index'
    ),
    array ()
);