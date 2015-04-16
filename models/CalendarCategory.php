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
	
	class CalendarCategory extends Record {
		const TABLE_NAME = 'calendar_category';
		public $category_key;
		public $cat_title;
		public $cat_image;
		public $cat_color;
		
	public function checkData() {
		$this->cat_title = trim($this->cat_title);
		$this->cat_image = trim($this->cat_image);
		$this->cat_color = trim($this->cat_color);
		if (empty($this->cat_title))
			{return false;}
		else {return true;}
	}
		


	public function getCategoryKey() {
		return $this->category_key;
	}

	public function getTitle() {
		return $this->cat_title;
	}

	public function getCategoryImage() {
		return $this->cat_image;
	}
	
	public function getColor() {
		return $this->cat_color;
	}
	
	
	static public function findCategoryById($id) {
		return self::findOneFrom(get_called_class(), "category_key = $id");
	}
	}
?>
