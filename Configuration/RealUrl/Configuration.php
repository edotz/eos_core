<?php

$realUrl = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Edotz\\EosCore\\Domain\\Model\\RealUrl', $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']);

$realUrlConfigHandler = function($params, $pObj) use ($realUrl) {
    $httpHost = (string)\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST');
    $realUrl->load($httpHost);
    if (null == $realUrl->getId()) {
        $realUrl->load('_DEFAULT');
    }
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'][$realUrl->getDomain()],
        $realUrl->getData(),
        true, false, true);
};
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['initFEuser']['edotz'] = $realUrlConfigHandler;


