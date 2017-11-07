-- --------------------------------------------------------
--
-- Additional fields for table 'pages'
--
CREATE TABLE pages (
    tx_eoscore_realurl int(11) DEFAULT '0' NOT NULL,
);

-- --------------------------------------------------------
--
-- Table structure for table 'tx_eoscore_domain_model_realurl'
--

CREATE TABLE tx_eoscore_domain_model_realurl (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    pages int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(128) DEFAULT '' NOT NULL,
    realurl_section varchar(64) DEFAULT '' NOT NULL,
    domain int(11) DEFAULT '0' NOT NULL,
    config text,
    
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,
    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY language (l10n_parent,sys_language_uid)
);

#
# Additional fields for table 'sys_template'
#
CREATE TABLE sys_template (
    tx_eoscore_google_tracking_id varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_google_api_key varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_google_site_verification varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_geo_lat double(10,6) DEFAULT '0.000000' NOT NULL,
    tx_eoscore_geo_lng double(10,6) DEFAULT '0.000000' NOT NULL,
    tx_eoscore_company_name varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_email varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_telephone varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_youtube varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_twitter varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_facebook varchar(255) DEFAULT '' NOT NULL,
    tx_eoscore_company_logo int(11) unsigned DEFAULT '0' NOT NULL,
);