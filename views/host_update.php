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

$edit_host = isset($host);
if (!$edit_host)
  $host = new CalendarHost();

?>

<h1><?php echo $edit_host ? __('Edit the host') : __('A new host'); ?></h1>

<form action="<?php echo BASE_URL; ?>plugin/mc_calendar/update_host" method="post">
    <fieldset style="padding:0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Edit the host'); ?></legend>
            <table class="fieldset" cellspacing="0" cellpadding="0" border="0">
                <?php if ($edit_host): ?>
                    <input type="hidden" name="host[id]" value="<?php echo $host->getId(); ?>" />
                <?php endif; ?>                
                <tr>
                    <td class="label"><label for="host-host_name"><?php echo __('Host'); ?></label></td>
                    <td class="field"><input type="text" id="host-name" name="host[host_name]" class="textbox" value="<?php echo $host->getHostName(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="host-host_email"><?php echo __('Email'); ?></label></td>
                    <td class="field"><input type="text" id="host-host_email" name="host[host_email]" class="textbox" value="<?php echo $host->getHostEmail(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="host-host_phone"><?php echo __('Mobile No.'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field"><input type="text" id="host-host_phone" name="host[host_phone]" class="textbox" value="<?php echo $host->getHostPhone(); ?>" /></td>
                </tr>     
                <tr>
                    <td class="label"><label for="host-host_alt_phone"><?php echo __('Alt Phone No.'); ?><br><small><?php echo " (".__('not required').")"; ?></small></label></td>
                    <td class="field"><input type="text" id="host-host_alt_phone" name="host[host_alt_phone]" class="textbox" value="<?php echo $host->getHostAltPhone(); ?>" /></td>
                </tr>     
 </table>
    </fieldset>
    <p class="buttons" align="right">
        <input class="button" type="submit" name="save" value="<?php echo __('Save'); ?>" /> or <a href="<?php echo get_url('plugin/mc_calendar/hosts'); ?>"><?php echo __('Cancel'); ?></a>
    </p>
</form>
