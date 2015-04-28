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
  
  const DAYS = 7;

  /** Prints the month containing the date
   * @param $_date null means ,today'
   */       
  public function display() {
    $lf = "\n";
    $today = new DateTime();
    $today->setTime(0,0);        
    try {    
      $date = new DateTime($this->date);
      $date->setTime(0,0);      
    }
    catch (Exception $e) {
      echo "<p class=\"error\">The date: $this->date is incorrect.</p>".$lf;
      return;
    }
      
    /* Calculate a date to begin with */
    $day   = $date->format('d');
    $month = $date->format('m');
    $year  = $date->format('Y');
    
    $date->setDate($year, $month, 1);
    $first_day_of_week = ($date->format('w') -1 + self::DAYS) % self::DAYS;
    $date->modify("-$first_day_of_week day");     
    
	foreach ($this->events as $event) {	
	  
	// get the host and category
		$host = CalendarHost::findByIdFrom('CalendarHost', $event->getHostId());
	    $category = CalendarCategory::findByIdFrom('CalendarCategory', $event->getCategoryKey());
		
		echo '<div class="card">'.$lf;
		
		// Card header
		echo '<div class="cardhead" style="background:'.$category->getColor().'">'.$lf;
		echo '<img class="right" src="'.URL_PUBLIC.'public/images/'.$category->getCategoryImage().'" alt="'.$category->getTitle().'">'.$lf;
		echo '<h2>';
		
		//Render the event date into dd MM format
		try {    
			$eventdate = new DateTime($event->getDateFrom());
			$eventdate->setTime(0,0);        
		}
		catch (Exception $e) {
		  echo "<p class=\"error\">The date: $this->date is incorrect.</p>".$lf;
		  return;
		}		
		$eventday   = $eventdate->format('d');
		$eventmonth = $eventdate->format('m');
		
		echo strftime("%e %B",$eventdate->getTimestamp());
		$starttime = $event->getStartTime();
		if (!empty($starttime)) 
			{echo ' - '.$starttime;}
		
		echo '</h2><h3>';
		echo $event->getTitle().'</h3></div>'.$lf;
		
		//Card body
		echo '<div class="cardbody">'.$lf;
		echo '<p>';
		echo $event->getDescription();
		echo '</p>';
		
		//Card footer
		echo '<div class="cardfooter">'.$lf;
		echo '<p>Contact: '.$host->getHostName();
		$hostmail = $host->getHostEmail();
		if (!empty($hostmail)) {
			echo ' (<a href="mailto:'.$hostmail.'">'.$hostmail.'</a>)';
		}
		echo '</p>';
		$hostphone = $host->getHostPhone();
		$hostaltphone = $host->getHostAltPhone();
		if (!empty($hostphone)) {
			echo '<p>Phone: '.$hostphone;
			if (!empty($hostaltphone)) {
				echo ' / '.$hostaltphone;
			}
			echo '</p>'.$lf;
		}
		echo '</div>'.$lf;
		echo '</div>'.$lf;
		
		echo '</div>'.$lf;
	}  
    
  }
  
   /**********************************************************************************************/  
  
public function __construct($base_path, $date = null, $events = array()) {
    $this->base_path = $base_path;
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
$date_prev = $datetime_prev->format("Y").'-'.$datetime_prev->format("m").'-01';
$date_next = $datetime_next->format("Y").'-'.$datetime_next->format("m").'-01';
$prev_url = get_url('plugin/mc_calendar/notices',$date_prev);
$next_url = get_url('plugin/mc_calendar/notices',$date_next);

echo '<span class="prev">';
//echo '<a href="'.$base_path.$date_prev.'">'.strftime("%B %Y", $datetime_prev->getTimestamp()).'</a></span>';
echo '<a href="'.$prev_url.'">'.strftime("%B %Y", $datetime_prev->getTimestamp()).'</a></span>';
echo " ".strftime("%B %Y", $datetime->getTimestamp())." ";

echo '<span class="next">';
echo '<a href="'.$next_url.'">'.strftime("%B %Y", $datetime_next->getTimestamp()).'</a></span>';

//echo "<span class=\"next\"><a href=\"$base_path".$datetime_next->format("Y")."-".$datetime_next->format("m")."-01\">".strftime("%B %Y", $datetime_next->getTimestamp())."</a></span>";
echo "</h3>";
echo "<br />";

$notices = new CalendarNotices($base_path, $date, $events);
$notices->display();

?>
</div>
