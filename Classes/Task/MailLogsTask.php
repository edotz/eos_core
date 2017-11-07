<?php 

namespace Edotz\EosCore\Task;

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

class MailLogsTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

    /**
     * 
     * @var string
     */
    public $recipient = '';
    
    /**
     * 
     * @var string
     */
    public $subject = '';
    
    /**
     * 
     * @var string
     */
    public $logfile = '';
    
    /**
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager = null;
    
    /**
     * 
     * @var \TYPO3\CMS\Core\Messaging\FlashMessageService
     */
    protected $flashMessageService = null;
    
    /**
     * 
     * @var array
     */
    protected $extensionConfiguration = array();
    
    /**
     * 
     * {@inheritDoc}
     * @see \TYPO3\CMS\Scheduler\Task\AbstractTask::execute()
     */
    public function execute() {
        $configurationUtility = $this->getObjectManager()->get('TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility');
        $this->extensionConfiguration = $configurationUtility->getCurrentConfiguration('eos_core');
        $logfile = PATH_site . $this->extensionConfiguration['logDir']['value'] . $this->logfile;
        if(file_exists($logfile) && !is_dir($logfile)) {
            $isSent = $this->sendMail($logfile);
            $this->archiveLogFile($logfile);
            return $isSent;
        }
        $this->addMessage($GLOBALS['LANG']->sL('LLL:EXT:eos_core/Resources/Private/Language/locallang_be.xlf:task.maillogs.error_logfile') . $logfile);
        return false;
    }
    
    /**
     * 
     * @param string $attachment
     */
    protected function sendMail($attachment) {
        $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $mail->setSubject($this->subject);
        $mail->setTo(array($this->recipient));
        $mail->setBody('Logfiles');
        $mail->attach(\Swift_Attachment::fromPath($attachment));
        return $mail->send();
    }
    
    /**
     * 
     * @param string $logfile
     */
    protected function archiveLogFile($logfile) {
        try {
            $archiveDir = PATH_site . $this->extensionConfiguration['logDir']['value'] . 'archive';
            if(!is_dir($archiveDir)) {
                GeneralUtility::mkdir($archiveDir);
            }
            rename($logfile, $archiveDir . DIRECTORY_SEPARATOR . date('Ymd') . '_' . $this->logfile);
            GeneralUtility::writeFile($logfile, '');
        }
        catch(\Edotz\App\Exception $e) {
            $this->addMessage($e->getMessage());
        }
    }
    
    /**
     * 
     * @param string $message
     * @param string $title
     * @param integer $severity
     */
    protected function addMessage($message, $title = 'Fehler aufgetreten', $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING) {
        $message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            $message,
            $title,
            $severity
        );
        $messageQueue = $this->getFlashMessageService()->getMessageQueueByIdentifier();
        $messageQueue->addMessage($message);
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
    
    /**
     * 
     * @return \TYPO3\CMS\Core\Messaging\FlashMessageService
     */
    protected function getFlashMessageService() {
        if($this->flashMessageService === null) {
            $this->flashMessageService = $this->getObjectManager()->get('TYPO3\CMS\Core\Messaging\FlashMessageService');
        }
        return $this->flashMessageService;
    }
}