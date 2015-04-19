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

$edit_event = isset($event);
if (!$edit_event)
  $event = new CalendarEvent();

?>

<h1><?php echo $edit_event ? __('Edit the event') : __('A new event'); ?></h1>

<form action="<?php echo BASE_URL; ?>plugin/mc_calendar/update_event" method="post">
    <fieldset style="padding:0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Edit the event'); ?></legend>
            <table class="fieldset" cellspacing="0" cellpadding="0" border="0">
                <?php if ($edit_event): ?>
                    <input type="hidden" name="event[id]" value="<?php echo $event->getId(); ?>" />
                    <input type="hidden" name="event[created_by_id]" value="<?php echo $event->getAuthorID(); ?>" />
                <?php endif; ?>                
                <tr>
                    <td class="label"><label for="event-title"><?php echo __('Title'); ?></label></td>
                    <td class="field"><input type="text" id="notes-title" name="event[title]" class="textbox" value="<?php echo $event->getTitle(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="event-date_from"><?php echo __('Date from'); ?></label></td>
                    <td class="field"><input type="text" id="event-date_from" name="event[date_from]" class="textbox" value="<?php echo $event->getDateFrom(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="event-date_to"><?php echo __('Date to'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field"><input type="text" id="event-date_to" name="event[date_to]" class="textbox" value="<?php echo $event->getDateTo(); ?>" /></td>
                </tr>                                
                <tr>
                    <td class="label"><label for="event-start_time"><?php echo __('Start time'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field"><input type="text" id="event-start_time" name="event[start_time]" class="textbox" value="<?php echo $event->getStartTime(); ?>" /></td>
                </tr>                                
                  <tr>
                    <td class="label"><label for="event-description"><?php echo __('Description'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="text">
                    <textarea id="event_description" name="event[description]" class="textarea" rows="10" cols="40"><?php echo htmlentities($event->getDescription(), ENT_COMPAT, 'UTF-8'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="label"><label for="event-image_url"><?php echo __('Image URL'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field"><input type="text" id="image_url" name="event[image_url]" class="textbox" value="<?php echo $event->getImageURL(); ?>" /></td>
                </tr>                                
 
                <tr>
                    <td class="label"><label for="event-category_key"><?php echo __('Category'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field">
 					<select id="category_key" name="event[category_key]">
					<?php
						$categories = CalendarCategory::getCategoryList();
						$thisCategory = $event->getCategoryKey();
						$hasCategory = isset($thisCategory);
						if (!$hasCategory) {
							echo '<option value="" disabled="disabled" selected="selected">';
							echo __('Please select a category');
							echo '</option>';
						}
						foreach ($categories as $category) {
							echo '<option value="'.$category->getId().'"';
							if ($category->getId() == $thisCategory) {
								echo ' selected="selected"';
							}
							echo '>'.$category->getTitle().'</option>';
						}
 					?>
					</select>
					</td>
				</tr> 
                <tr>
                    <td class="label"><label for="event-host_id"><?php echo __('Host'); ?></label></td>
					<td class="field"> 
					<select id="host_id" name="event[host_id]">
					<?php
						$hosts = CalendarHost::getHostList();
						$thisHost = $event->getHostId();
						$hasHost = isset($thisHost);
						if (!$hasHost) {
							echo '<option value="" disabled="disabled" selected="selected">';
							echo __('Please select a host');
							echo '</option>';
						}
						foreach ($hosts as $host) {
							echo '<option value="'.$host->getId().'"';
							if ($host->getId() == $thisHost) {
								echo ' selected="selected"';
							}
							echo '>'.$host->getHostName().'</option>';
						}
 					?>
					</select>
                    </td>
                </tr>                                

 </table>
    </fieldset>
    <p class="buttons" align="right">
        <input class="button" type="submit" name="save" value="<?php echo __('Save'); ?>" /> or <a href="<?php echo get_url('plugin/mc_calendar/events'); ?>"><?php echo __('Cancel'); ?></a>
    </p>
</form>
