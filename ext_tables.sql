
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