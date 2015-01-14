#
# Table structure for table 'tx_sfmysqlreport_domain_model_profile'
#
CREATE TABLE tx_sfmysqlreport_domain_model_profile (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	query_id int(11) unsigned DEFAULT '0',
	mode char(3) DEFAULT '' NOT NULL,
	unique_call_identifier varchar(15) DEFAULT '' NOT NULL,
	duration double(11,8) DEFAULT '0.00000000' NOT NULL,
	query tinyblob NOT NULL,
	query_type varchar(20) DEFAULT '' NOT NULL,
	profile text NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY profiles (crdate,query_type,duration),
);