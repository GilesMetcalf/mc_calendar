<?php
/**
* This file is part of the "MensaCymru Calendar" plugin for Wolf CMS.
* Licensed under an GPL style license. For full details see license.txt.
*
* @author Giles Metcalf <giles@lughnasadh.com>
* @copyright Giles Metcalf, 2015
*
* Original authors:
*
* @author Jacek Ciach <jacek.ciach@wp.eu>
* @copyright Jacek Ciach, 2014
*
*/

	if (!defined('IN_CMS')) { exit(); }
	// Connect
	$PDO = Record::getConnection();
	$success = 1;
	
	// Main calendar events table
	$sql_table =
	"CREATE TABLE ".TABLE_PREFIX."calendar (
		id int NOT NULL AUTO_INCREMENT,
		created_by_id int NOT NULL,
		title varchar(256) NOT NULL,
		date_from date NOT NULL,
		date_to date NULL,
		description text NULL,
		category_key int NOT NULL,
        image_url varchar(50) NULL,
        host_id int NULL,		
		PRIMARY KEY (id),
		KEY date_from (date_from)
	) ENGINE=MyISAM";
	if ($PDO->exec($sql_table) === false) {$success = 0;}
	
	// Calendar categories table
	$sql_table =
	"CREATE TABLE ".TABLE_PREFIX."calendar_category (
		category_key int NOT NULL AUTO_INCREMENT,
		cat_title varchar(50) NOT NULL,
        cat_image varchar(50) NULL,
		cat_color varchar(10) NULL,
		PRIMARY KEY (category_key)
	) ENGINE=MyISAM";
	if ($PDO->exec($sql_table) === false) {$success = 0;}

	// Calendar hosts table
	$sql_table =
	"CREATE TABLE ".TABLE_PREFIX."calendar_hosts (
		host_id int NOT NULL AUTO_INCREMENT,
		host_name varchar(50) NOT NULL,
        host_email varchar(50) NULL,
		host_phone varchar(50) NULL,
		host_alt_phone varchar(50) NULL,
		PRIMARY KEY (host_id)
	) ENGINE=MyISAM";
	if ($PDO->exec($sql_table) === false) {$success = 0;}
	
	// Create at least one category entry
	$sql_populate = 
	"INSERT INTO ".TABLE_PREFIX."calendar_category (
		cat_title, cat_image, cat_color)
		VALUES ('General', 'gen_icon', '#66FF66')";
	if ($PDO->exec($sql_populate) === false) {$success = 0;}
	
	$sql_procedure =
	"CREATE PROCEDURE Calendar_GenerateDates (IN date_from date, IN date_to date)
		begin
		declare the_date date;
		create temporary table if not exists __dates (value date not null primary key);
		set the_date = date_from;
		while the_date <= date_to do
		replace into __dates values(the_date);
		set the_date = the_date + interval 1 day;
		end while;
		end";
	if ($PDO->exec($sql_procedure) === false) {$success = 0;}
	
	if ($success == 0) {
		Flash::set('error', __('Error occured during installing the calendar'));
	} else {
		Flash::set('success', __('Calendar is enabled!'));
	}
?>
