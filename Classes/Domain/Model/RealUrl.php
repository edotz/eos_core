<?php

namespace Edotz\EosCore\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
 * SysTemplate Model
 */
Class RealUrl extends \Edotz\App\Object\Model implements \TYPO3\CMS\Core\SingletonInterface {


    const TABLE = 'tx_eoscore_domain_model_realurl';

    /**
    * cacheUtility
    *
    * @var \TYPO3\CMS\Core\Cache\CacheManager
    */
    protected $cache;

    /**
     * domain
     *
     * @var string
     */
    protected $domain;

    protected $uidFieldName = 'pid';


    public function __construct()  {        
        
    }    
    
    protected function _construct()
    {
        $this->setOrigData();
    }


    /**
     * Retrieves domain info
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }


    protected function getCache()
    {
        if (!isset($this->cache)) {
            $this->cache = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager')->getCache('eos_core');
        }
        return $this->cache;
    }

    protected function setFixedPostVars($config)
    {
        $fixedPostVars = $this->getDataSetDefault('fixedPostVars', array());
        $fixedPostVars[(string)$this->getId()] = $config;
        return $this->setData('fixedPostVars', $fixedPostVars);
    }

    protected function setPostVarSets($config)
       {
        $postVarSets = $this->getDataSetDefault('postVarSets', array());
        $postVarSets[(string)$this->getId()] = $config;
        return $this->setData('postVarSets', $postVarSets);
    }

    public function load($domain)
    {
        $this->domain = (empty($domain)) ? '_DEFAULT' : $domain;
        if (false == ($data = $this->getCache()->get(GeneralUtility::shortMD5($this->domain)))) {
            $data = $this->getOrigData($this->domain);
        }
        else {
            $data = unserialize($data);
        }
        $this->setData($data)->setOrigData();
        return $this;
    }

    public function save()
    {
        if ($this->getId() && $this->hasDataChanges()) {
            $this->getCache()->set(GeneralUtility::shortMD5($this->domain), serialize($this->getData()), array(), \TYPO3\CMS\Core\Cache\Backend\AbstractBackend::UNLIMITED_LIFETIME);
        }
    }


    public function addSectionConfig($section, $config)
    {
        $config = json_decode(trim($config), true);
        if (!is_array($config) || empty($config)) {
            throw new \Edotz\App\Exception('Could not decode realurl json configuration');
        }
        $method = 'set' . \Edotz\App\Utility\GeneralUtility::formatName($section);
        if (!method_exists($this, $method)) {
            DebuggerUtility::var_dump("Method {$method} is not implemented");
            //throw new \Edotz\App\Exception("Method {$method} is not implemented");
        }
        $this->$method($config);
        return $this;
    }

}