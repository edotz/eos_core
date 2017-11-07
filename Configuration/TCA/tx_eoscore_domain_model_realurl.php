<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$translationPrefix = 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:tx_eoscore_domain_model_realurl';


return [
    'ctrl' => [
        'groupName'     => 'edotz',
        'title'         => $translationPrefix,
        'label'         => 'title',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'dividers2tabs' => TRUE,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'        => 'deleted',
        'enablecolumns' => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ],
        'searchFields'  => 'title,config',
        'iconfile'      => 'EXT:eos_core/Resources/Public/Icons/eos.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, realurl_section, config',
    ],
    'types' => [
        '1' => ['showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,title;;1;;--0,realurl_section,domain,config;;;;--0'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'hidden,--linebreak--,starttime,endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                        ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                        ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_eoscore_domain_model_realurl',
                'foreign_table_where' => 'AND tx_eoscore_domain_model_realurl.pid=###CURRENT_PID### AND tx_eoscore_domain_model_realurl.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'pages' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'sorting' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'title' => [
            'label' => $translationPrefix . '.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'realurl_section' => [
            'label' => $translationPrefix . '.realurl_section',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        '',
                        ''
                    ],
                    [
                        'fixedPostVars',
                        'fixedPostVars'
                    ],
                    [
                        'postVarSets',
                        'postVarSets'
                    ],

                ],
            ],
         ],
        'domain' => [
            'exclude' => 0,
            'label' => $translationPrefix . '.domain',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'items' => [
                    [
                        'default',
                        0
                    ],
                ],
                'foreign_table' => 'sys_domain',
                'foreign_table_where' => ' AND sys_domain.redirectTo = ""',
            ]
        ],
        'config' => [
            'label' => $translationPrefix . '.config',
            'config' => [
                'type' => 'text',
                'cols' => '60',
                'rows' => '10',
                'eval' => 'required,trim,Edotz\\EosCore\\Evaluation\\JsonEvaluation'
            ],
        ],
    ],     
];
