<?php

namespace Edotz\EosCore\Hook;

use Edotz\EosCore\Domain\Model\RealUrl;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
        
    
/**
 * DataHandler: Hook to update needed lookup variables
 *
 *
 */
class RealUrlDataHook extends \Edotz\App\Object\Data
{

 
    /**
     * Retrieve domainName value form sys_domain database table
     *
     * @param integer domain $uid
     * @return string domainName or false
     */
    protected function getDomainNameFromRecord($uid)
    {
        $data = BackendUtility::getRecord('sys_domain', $uid, 'domainName', " AND redirectTo=\'\' AND hidden=0");
        if ($data && isset($data['domainName'])) {
            return $data['domainName'];
        }
        return $data;
    }


    /**
     * Safely check for redirect links and generate query hash
     *
     * @param string $type
     * @param string $table
     * @param string $id
     * @param array $row
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $reference
     */
    public function processDatamap_postProcessFieldArray($type, $table, $id, &$row, $reference)
    {
        $method = 'process' .  \Edotz\App\Utility\GeneralUtility::formatName($table);
        if (empty($type) || !method_exists($this, $method)) {
            return;
        }
        $this->$method($id, $row, $reference);
    }

                    
    protected function processTxEoscoreDomainModelRealurl($id, &$row, $reference)
    {

        if (isset($row['config']) && !strstr($row['config'], 'PARSE-ERROR')) {
            
            if (isset($reference->datamap[RealUrl::TABLE][$id])) {
                $this->setData($reference->checkValue_currentRecord);
            }
            $this->addData($row);
            if (intval($this->getData('domain')) > 0) {
                if (false !== ($domainName = $this->getDomainNameFromRecord($this->getData('domain')))) {
                    $this->setData('domain', $domainName);
                }
            }
            $realUrl = GeneralUtility::makeInstance(RealUrl::class);
            $realUrl->load($this->getData('domain'))->setId($this->getData('pid'))
                    ->addSectionConfig($this->getData('realurl_section'), $this->getData('config'))
                    ->save();
        }

    }

}