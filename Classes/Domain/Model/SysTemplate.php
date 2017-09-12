<?php

namespace Edotz\EosCore\Domain\Model;

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
class SysTemplate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    /**
     * 
     * @var string
     */
    protected $googleTrackingId = '';
    
    /**
     * 
     * @var string
     */
    protected $googleApiKey = '';
    
    /**
     * 
     * @var string
     */
    protected $geoLat = '';
    
    /**
     * 
     * @var string
     */
    protected $geoLng = '';
    
    /**
     * 
     * @var string
     */
    protected $companyName = '';
    
    /**
     * 
     * @var string
     */
    protected $companyEmail = '';
    
    /**
     * 
     * @var string
     */
    protected $companyTelephone = '';
    
    /**
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $companyLogo;
    

    /**
     * googleTrackingId
     * @return string
     */
    public function getGoogleTrackingId(){
        return $this->googleTrackingId;
    }

    /**
     * googleApiKey
     * @return string
     */
    public function getGoogleApiKey(){
        return $this->googleApiKey;
    }

    /**
     * geoLat
     * @return string
     */
    public function getGeoLat(){
        return $this->geoLat;
    }

    /**
     * geoLng
     * @return string
     */
    public function getGeoLng(){
        return $this->geoLng;
    }

    /**
     * companyName
     * @return string
     */
    public function getCompanyName(){
        return $this->companyName;
    }

    /**
     * companyEmail
     * @return string
     */
    public function getCompanyEmail(){
        return $this->companyEmail;
    }

    /**
     * companyTelephone
     * @return string
     */
    public function getCompanyTelephone(){
        return $this->companyTelephone;
    }

    /**
     * companyLogo
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCompanyLogo(){
        return $this->companyLogo;
    }

}