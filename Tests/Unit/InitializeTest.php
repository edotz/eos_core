<?php

namespace Edotz\EosCore\Test\Unit;

/*
 * **************************************************************
 *
 * Copyright notice
 *
 * (c) 2017 Edotz staff <staff@edotz.net>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * *************************************************************
 */
use FluidTYPO3\Development\AbstractTestCase;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Extbase\Reflection\PropertyReflection;
use FluidTYPO3\Flux\Core;
use TYPO3\CMS\Core\Utility\DebugUtility;

/**
 * ContentController
 */
class InitializeTest extends AbstractTestCase {
    
    /**
     *
     * @return void
     */
    public function setUp() 
    {
    }
    
    public function testRegisterProviderExtensionKey() 
    {
        $fluxCore = $this->objectManager->get( Core::class );
        $fluxCore->registerProviderExtensionKey( 'eos_core', 'Content' );
        $registeredExtensions = $this->callInaccessibleProperty( $fluxCore, 'extensions' );
        $this->assertContains( 'eos_core', $registeredExtensions ['Content'] );
    }
    
    public function testRealUrlConfigurationExists() 
    {
        $realUrlConfigurationFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('eos_core', '/Configuration/RealUrl/Configuration.php');
        $this->assertFileExists($realUrlConfigurationFile);
    }
    
    /**
     * Helper function to call protected or private methods
     * @param object $object The object to be invoked
     * @param string $name the name of the property to return
     * @return mixed
     */
    protected function callInaccessibleProperty($object, $name) {
        $reflectionObject = new \ReflectionObject ( $object );
        $reflectionProperty = $reflectionObject->getProperty ( $name );
        $reflectionProperty->setAccessible( true );
        return $reflectionProperty->getValue( $object );
    }
}