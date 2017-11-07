<?php 

namespace Edotz\EosCore\Task;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 edotz online services GmbHf <staff@edotz.net>
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
 * MailLogs
 */

class MailLogsAdditionalFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface {
    
    /**
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager = null;
    
    protected $extensionConfiguration = array();
    
    public function __construct() {
        $configurationUtility = $this->getObjectManager()->get('TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility');
        $this->extensionConfiguration = $configurationUtility->getCurrentConfiguration('eos_core');
    }
    
    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $additionalFields = [];
        $additionalFields['recipient'] = $this->getAdditionalField('recipient', $taskInfo, $task, $parentObject);
        $additionalFields['subject']   = $this->getAdditionalField('subject', $taskInfo, $task, $parentObject);
        $additionalFields['logfile']   = $this->getAdditionalFieldLogfile($taskInfo, $task, $parentObject);
        return $additionalFields;
    }
    
    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $validData = $this->validateAdditionalField('recipient', $submittedData, $parentObject);
        $validData &= $this->validateAdditionalField('subject', $submittedData, $parentObject);
        $validData &= $this->validateAdditionalField('logfile', $submittedData, $parentObject);
        return $validData;
    }
    
    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) {
        $task->recipient = $submittedData['eos_maillogs_recipient'];
        $task->subject   = $submittedData['eos_maillogs_subject'];
        $task->logfile   = $submittedData['eos_maillogs_logfile'];
    }
    
    protected function getAdditionalField($field, array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $fieldName = 'eos_maillogs_' . $field;
        if ($parentObject->CMD === 'edit') {
            $taskInfo[$fieldName] = $task->$field;
        }
        
        $fieldId = 'task_' . $fieldName;
        $fieldHtml = '<input class="form-control" type="text" ' . 'name="tx_scheduler[' . $fieldName . ']" ' . 'id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo[$fieldName]) . '" size="30">';
        
        $fieldConfiguration = [
                'code' => $fieldHtml,
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.' . $field,
                'cshKey' => '',
                'cshLabel' => $fieldId
        ];
        return $fieldConfiguration;
    }
    
    protected function getAdditionalFieldLogfile(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $fieldName = 'eos_maillogs_logfile';
        if ($parentObject->CMD === 'edit') {
            $taskInfo[$fieldName] = $task->logfile;
        }
        $options = array();
        $options[] = '<option value="">--</option>';
        foreach($this->getLogfiles($parentObject) as $logfile) {
            $selected = ($taskInfo[$fieldName] == $logfile) ? "selected='selected'" : '';
            $options[] = '<option value="' . $logfile . '" ' . $selected . '>' . $logfile . '</option>';
        }
        
        $fieldId = 'task_' . $fieldName;
        $fieldHtml = '<select class="form-control" name="tx_scheduler[' . $fieldName . ']" id="' . $fieldId . '">' . implode(LF, $options) . '</select>';
        $fieldConfiguration = [
                'code' => $fieldHtml,
                'label' => 'LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.logfile',
                'cshKey' => '',
                'cshLabel' => $fieldId
        ];
        return $fieldConfiguration;
    }
    
    protected function validateAdditionalField($field, array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
        $fieldName = 'eos_maillogs_' . $field;
        
        // Als Beispiel für Validierung
        $submittedData[$fieldName] = strip_tags($submittedData[$fieldName]);
        
        if($submittedData[$fieldName] !== '') {
            return true;
        }
        $parentObject->addMessage(sprintf($GLOBALS['LANG']->sL('LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.error'), $field), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        return false;
    }
    
    protected function getLogfiles($parentObject) {
        if(!isset($this->extensionConfiguration['logDir'])) {
            $parentObject->addMessage($GLOBALS['LANG']->sL('LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.error_logdir'), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        $path = PATH_site . $this->extensionConfiguration['logDir']['value'];
        if(empty($files = GeneralUtility::getFilesInDir($path, 'log'))) {
            $parentObject->addMessage($GLOBALS['LANG']->sL('LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.error_logfiles'), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        return $files;
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


