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
	
	class CalendarHost extends Record {
		const TABLE_NAME = 'calendar_hosts';
		public $id;
		public $host_name;
		public $host_email;
		public $host_phone;
		public $host_alt_phone;
		
	public function checkData() {
		$this->host_name = trim($this->host_name);
		$this->host_email = trim($this->host_email);
		$this->host_phone = trim($this->host_phone);
		$this->host_alt_phone = trim($this->host_alt_phone);
		if (empty($this->host_name))
			{return false;}
		else {return true;}
	}
		

	public function getId() {
		return $this->id;
	}

	public function getHostName() {
		return $this->host_name;
	}

	public function getHostEmail() {
		return $this->host_email;
	}
	
	public function getHostPhone() {
		return $this->host_phone;
	}

	public function getHostAltPhone() {
		return $this->host_alt_phone;
	}
	
	
	static public function findHostById($id) {
		return self::findOneFrom(get_called_class(), "id = $id");
	}
	
	static public function getHostList() {
			return self::findAllFrom(get_called_class());
	}


}


?>
