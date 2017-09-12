<?php

namespace Edotz\EosCore\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Edotz staff <staff@edotz.net>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ContentController
 */
class ConfigurationService implements SingletonInterface {
    
    /**
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager = null;
    
    /**
     * 
     * @var \TYPO3\CMS\Core\TypoScript\TemplateService
     */
    protected $templateService = null;
    
    public function setTypoScriptFromTemplateFields() {
        $pageUid = (TYPO3_MODE == 'FE') ? $GLOBALS['TSFE']->id : GeneralUtility::_GET('id');
        $rootline = BackendUtility::BEgetRootLine($pageUid);
        $sqlIdField = $GLOBALS['TYPO3_DB']->quoteStr('pid', 'sys_template');
        $sqlId = $GLOBALS['TYPO3_DB']->fullQuoteStr($rootline[1]['uid'], 'sys_template');
        $rootTemplate = reset($GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'sys_template', $sqlIdField . ' = ' . $sqlId));
        $this->setGlobalTyposciptConfiguration($rootTemplate);
    }
    
    protected function setGlobalTyposciptConfiguration($rootTemplate) {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['defaultTypoScript_constants.']['eoscore'] = '
            company.name = ' .  $rootTemplate['tx_eoscore_company_name'] . '
            company.email = ' .  $rootTemplate['tx_eoscore_company_email'] . '
            company.telephone = ' .  $rootTemplate['tx_eoscore_company_telephone'] . '
            company.youtube = ' .  $rootTemplate['tx_eoscore_company_youtube'] . '
            company.twitter = ' .  $rootTemplate['tx_eoscore_company_twitter'] . '
            company.facebook = ' .  $rootTemplate['tx_eoscore_company_facebook'] . '
            google.tracking_id = ' .  $rootTemplate['tx_eoscore_google_tracking_id'] . '
            google.api_key = ' .  $rootTemplate['tx_eoscore_google_api_key'] . '
            google.site_verification = ' .  $rootTemplate['tx_eoscore_google_site_verification'] . '
            geo.lat = ' .  $rootTemplate['tx_eoscore_geo_lat'] . '
            geo.lng = ' .  $rootTemplate['tx_eoscore_geo_lng'] . '
        ';
    }
    
    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected function getObjectManager()
    {
        if($this->objectManager === null) {
            $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        }
        return $this->objectManager;
    }
    
}
