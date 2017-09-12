<?php
$EM_CONF[$_EXTKEY] = array(
	'title' => 'Edotz online services - core',
	'description' => 'Edotz typo3 core application extension',
	'category' => 'misc',
	'author' => 'Edotz Staff',
	'author_email' => 'staff@edotz.net',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'clearCacheOnLoad' => 0,
	'version' => '0.0.1',
	'constraints' =>
    array (
        'depends' =>
            array (
            		'php' => '7.0.0-7.1.99',
            		'typo3' => '7.6.13-8.7.99',
            ),
        'conflicts' =>
            array (),
        'suggests' =>
            array (),
	)
);