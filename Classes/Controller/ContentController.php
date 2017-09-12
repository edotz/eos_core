<?php

namespace Edotz\EosCore\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
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
 * ContentController
 */
class ContentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    
    public function indexAction() {
        $templatesPath = ExtensionManagementUtility::extPath('eos_core') . 'Resources/Private/Templates/Content';
        $fluidContentTemplates = GeneralUtility::getFilesInDir($templatesPath, 'html');
        foreach($fluidContentTemplates as $template) {
            if($template == 'Index.html') {
                continue;
            }
            $templateView = $this->objectManager->get('TYPO3\CMS\Fluid\View\StandaloneView');
            $templateView->setTemplatePathAndFilename($templatesPath . '/' . $template);
            $templateView->setLayoutRootPaths(array(ExtensionManagementUtility::extPath('eos_core') . 'Resources/Private/Layouts/'));
            $templateView->assign('settings',array('renderMode' => 'preview'));
            $content .= $templateView->render(); 
        }
        $this->view->assign('content', $content);
    }
    
}
