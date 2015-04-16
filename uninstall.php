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

$PDO = Record::getConnection();

if($PDO->exec('DROP TABLE IF EXISTS '.TABLE_PREFIX.'calendar') === false ||
$PDO->exec('DROP TABLE IF EXISTS '.TABLE_PREFIX.'calendar_category') === false ||
$PDO->exec('DROP TABLE IF EXISTS '.TABLE_PREFIX.'calendar_hosts') === false ||
$PDO->exec('DROP PROCEDURE IF EXISTS Calendar_GenerateDates') === false) {
    Flash::set('error', __('Calendar is not uninstalled!'));
    redirect(get_url('setting'));
}
else
	Flash::set('success', __('Calendar is uninstalled!'));

?>
