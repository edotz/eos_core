<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$newFieldsSysTemplate = array(
		'tx_eoscore_google_tracking_id' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_google_tracking_id',
		        'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_google_api_key' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_google_api_key',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_google_site_verification' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_google_site_verification',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_geo_lng' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_geo_lng',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_geo_lat' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_geo_lat',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_name' => array(
				'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_name',
                'displayCond' => 'FIELD:root:REQ:true',
				'config' => array(
						'type' => 'input',
        				'size' => '20',
        				'max' => '256'
				)
		),
        'tx_eoscore_company_email' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_email',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_telephone' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_telephone',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_youtube' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_youtube',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_twitter' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_twitter',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_facebook' => array(
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_facebook',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '256'
                )
        ),
        'tx_eoscore_company_logo' => [
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tx_eoscore_company_logo',
                'displayCond' => 'FIELD:root:REQ:true',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('company_logo', [
                        'appearance' => [
                                'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                        ],
                        // custom configuration for displaying fields in the overlay/reference table
                        // to use the imageoverlayPalette instead of the basicoverlayPalette
                        'foreign_types' => [
                                '0' => [
                                        'showitem' => '
                							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                							--palette--;;filePalette'
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                        'showitem' => '
                							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                							--palette--;;filePalette'
                                ]
                        ],
                        'maxitems' => '1'
                ], 'png,svg')
        ],
        
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_template', $newFieldsSysTemplate);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_template', 'tx_eoscore_google', 'tx_eoscore_google_tracking_id,tx_eoscore_google_api_key,tx_eoscore_google_site_verification,--linebreak--,tx_eoscore_geo_lat, tx_eoscore_geo_lng');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_template', 'tx_eoscore_company', 'tx_eoscore_company_name,tx_eoscore_company_telephone,tx_eoscore_company_email,--linebreak--,tx_eoscore_company_youtube,tx_eoscore_company_twitter,tx_eoscore_company_facebook,--linebreak--,tx_eoscore_company_logo');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_template', 
        '--div--;LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.tab.configuration,
        --palette--;LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.palette.google;tx_eoscore_google,
        --palette--;LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template.palette.company;tx_eoscore_company,
        LLL:EXT:eos_core/Resources/Private/Language/locallang_db.xlf:sys_template',
        '',
        'after:static_file_mode');

