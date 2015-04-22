<?php
/**
* This file is part of the "MensaCymru Calendar" plugin for Wolf CMS.
* Licensed under an GPL style license. For full details see license.txt.
*
* @author Giles Metcalf <giles@lughnasadh.com>
* @copyright Giles Metcalf, 2015
*
*/
?>

<div id="mainbox">


<?php

error_reporting(E_ALL | E_NOTICE);

class CalendarNotices {

  private $date;
  private $events;
  private $base_path;
  

  /** Prints the month containing the date
   * @param $_date null means ,today'
   */       
  public function display() {
    $today = new DateTime();
    $today->setTime(0,0);        
    try {    
      $date = new DateTime($this->date);
      $date->setTime(0,0);      
    }
    catch (Exception $e) {
      echo "<p class=\"error\">The date: $this->date is incorrect.</p>\n";
      return;
    }
      
    /* Calculate a date to begin with */
    $day   = $date->format('d');
    $month = $date->format('m');
    $year  = $date->format('Y');
    
    $date->setDate($year, $month, 1);
    $first_day_of_week = ($date->format('w') -1 + self::DAYS) % self::DAYS;
    $date->modify("-$first_day_of_week day");     
    
	foreach ($events as $event) {	
	  
	// get the host and category
		$host = CalendarHost::findByIdFrom('CalendarHost', $event->getHostId());
	    $category = CalendarCategory::findByIdFrom('CalendarCategory', $event->getCategoryKey());
		
		echo '<div class=\"card\">\n';
		
		// Card header
		echo '<div class=\"cardhead\" style=\"background:'.$category->getColor().'\">\n';
		echo '<img class=\"right\" src="'.URL_PUBLIC.'public/images/'.$category->getCategoryImage().'\">\n';
		echo '<h2>';
		
		//Render the event date into dd MM format
		try {    
			$eventdate = new DateTime($event->getDateFrom());
			$eventdate->setTime(0,0);        
		}
		catch (Exception $e) {
		  echo "<p class=\"error\">The date: $this->date is incorrect.</p>\n";
		  return;
		}		
		$eventday   = $eventdate->format('d');
		$eventmonth = $eventdate->format('m');
		
		echo $eventday.' '.$eventmonth;
		if (isset($event->getStartTime()) {
			echo ' - '.getStartTime();
		}
		echo '</h2><h3>';
		echo $event->getTitle().'</h3></div>\n';
		
		//Card body
		echo '<div class=\"cardbody\">\n';
		echo '<p>';
		echo $event->getDescription();
		echo '</p></div>\n';
		
		//Card footer
		echo '<div class=\"cardfooter\">\n';
		echo '<p>Contact: '.$host->getHostName();
		if (isset($host->getHostEmail()) {
			echo ' (<a href=\"mailto:'.$host->getHostName().'\">'.$host->getHostName().'</a>)';
		}
		echo '</p>\n';
		if (isset($host->getHostPhone()) {
			echo '<p>Phone: '.$host->getHostPhone();
			if (isset($host->getHostAltPhone()) {
				echo ' / '.$host->getHostAltPhone();
			}
			echo '</p>\n';
		}
		echo '</div>\n';
		
		
		echo '</div>\n';
	}  
    
  }
  
   /**********************************************************************************************/  
  
public function __construct($base_path, $date = null, $events = array()) {
    $this->base_path = $base_path;
    $this->day_names = self::getDaysNames("%a");
    $this->date = $date;
    $this->events = $events;
  }
  
} // END: class CalendarTable

$date = isset($date) ? $date : null;
$events  = isset($events)  ? $events  : array();

$datetime = new DateTime($date);
$datetime_prev = clone($datetime);
$datetime_prev->modify("first day of previous month");
$datetime_next = clone($datetime);
$datetime_next->modify("first day of next month");

echo "<h3>";
echo "<span class=\"prev\"><a href=\"$base_path/".$datetime_prev->format("Y")."/".$datetime_prev->format("m")."\">".strftime("%B %Y", $datetime_prev->getTimestamp())."</a></span>";
echo " ".strftime("%B %Y", $datetime->getTimestamp())." ";
echo "<span class=\"next\"><a href=\"$base_path/".$datetime_next->format("Y")."/".$datetime_next->format("m")."\">".strftime("%B %Y", $datetime_next->getTimestamp())."</a></span>";
echo "</h3>";

$notices = new CalendarNotices($base_path, $date, $events);
$notices->display();

?>
</div>
