<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
$tempColumns = [
    'tx_eoscore_realurl' => [
        'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:pages.tx_eoscore_realurl',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_eoscore_domain_model_realurl',
            'foreign_field' => 'pages',
            'foreign_sortby' => 'sorting',
            //'foreign_label_alt' => 'lastname',
            //'foreign_label_alt' => 'firstname',
            //'foreign_label_alt_force' => 1,
            'appearance' => [
               'collapseAll' => 1,
               'expandSingle' => 1
            ]
        ],
//         'displayCond' => [
//             'OR' => [
//                 'FIELD:backend_layout:=:9',
//                 'FIELD:backend_layout:=:8',
//                 'FIELD:backend_layout:=:11',
//             ]
//         ]
    ],
];

// add tca config to TCA columns
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns );
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,tx_eoscore_realurl;;;;--0');
