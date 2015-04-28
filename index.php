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

if (!defined('CALENDAR_USE_STORED_PROCEDURE')) define('CALENDAR_USE_STORED_PROCEDURE', true);

Plugin::setInfos(array(
    'id'          => 'mc_calendar',
    'title'       => __('Calendar'),
    'description' => __('Calendar'),
    'version'     => '0.1',
    'license'     => 'GPL',
    'author'      => 'Giles Metcalf',
    'require_wolf_version' => '0.7.8',
    'website'     => 'https://github.com/GilesMetcalf/mc_calendar/',
    'update_url'  => 'https://wolfcms-calendar-plugin.googlecode.com/svn/calendar-version.xml'
));

define('CALENDAR_VIEWS', 'mc_calendar/views');

Plugin::addController('mc_calendar', __('Calendar'),'administrator, developer, editor, user', true);
AutoLoader::addFile('CalendarEvent', CORE_ROOT.'/plugins/mc_calendar/models/CalendarEvent.php');
AutoLoader::addFile('CalendarCategory', CORE_ROOT.'/plugins/mc_calendar/models/CalendarCategory.php');
AutoLoader::addFile('CalendarHost', CORE_ROOT.'/plugins/mc_calendar/models/CalendarHost.php');
Behavior::add('mc_calendar', 'mc_calendar/behaviour.php');
Dispatcher::addRoute(array(
    '/notices'         => 'plugin/mc_calendar/showNotices',
    '/notices/:any' => 'plugin/mc_calendar/showNotices/$1'
));


function showCalendar($slug, $date = null) {
  $date_begin = new DateTime($date);
  $date_begin->modify("first day of this month"); 
  $date_begin->modify("-1 week");
  $date_begin = $date_begin->format('Y-m-d');
  
  $date_end = new DateTime($date);
  $date_end->modify("last day of this month"); 
  $date_end->modify("+1 week");
  $date_end = $date_end->format('Y-m-d');    
  
  $events = CalendarEvent::generateAllEventsBetween($date_begin, $date_end);
  $events_map = array();
  foreach ($events as $event) {
    $events_map[$event->value][] = $event->getTitle();      
  }
  
  $calendar = new View(
                    PLUGINS_ROOT.DS.CALENDAR_VIEWS.'/calendar_table',
                    array(
                      'base_path' => BASE_URL.$slug,
                      'date'      => $date,
                      'map'       => $events_map,
					  'events' 	  => $events
                    ));
  $calendar->display();
}

function showNoticeBoard($date = null) {
  $date_begin = new DateTime($date);
  $date_begin->modify("first day of this month"); 
  $date_begin->modify("-1 week");
  $date_begin = $date_begin->format('Y-m-d');
  
  $date_end = new DateTime($date);
  $date_end->modify("last day of this month"); 
  $date_end->modify("+1 week");
  $date_end = $date_end->format('Y-m-d');    
  
  $events = CalendarEvent::generateAllEventsBetween($date_begin, $date_end);
  //$events_map = array();
  
  $notices = new View(
                    PLUGINS_ROOT.DS.CALENDAR_VIEWS.'/calendar_notices',
                    array(
                      'base_path' => BASE_URL.'/showNoticeBoard/',
                      'date'      => $date,
                      'events'       => $events
                    ));
  $notices->display();
}

function showEvent($event, $show_author = true) {   
  /* Prepare the event's data */
  $vars['id']    = $event->getId();  
  $vars['title'] = $event->getTitle();
  
  $date_from = new DateTime($event->getDateFrom());
  $vars['date_from'] = strftime("%x", $date_from->getTimestamp());
  
  if (empty($event->date_to))
    $vars['date_to'] = null;
  else {
    $date_to = new DateTime($event->getDateTo()); 
    $vars['date_to'] = strftime("%x", $date_to->getTimestamp());
  }
  
  $vars['days']    = $event->getLength();
  $vars['author']  = $event->getAuthor();
  $vars['content'] = $event->getContent();
  
  $vars['show_author'] = $show_author;    
 
  /* Display an event */
  $view = new View(PLUGINS_ROOT.DS.CALENDAR_VIEWS.'/event_frontend', $vars);
  $view->display();  
}

function showEvents(array $events) {
  foreach ($events as $event)
    showEvent($event);
}
