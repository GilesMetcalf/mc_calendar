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

?>

<h1><?php echo __('All hosts'); ?></h1>
    <table class="index" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <td><?php echo __('Id'); ?></td>
                <td><?php echo __('Host'); ?></td>
                <td><?php echo __('Email'); ?></td>
                <td><?php echo __('Mobile No.'); ?></td> 
                <td><?php echo __('Alt Phone No.'); ?></td> 				
                <td><?php echo __('Delete'); ?></td>
            </tr>
        </thead>

        <?php foreach($hosts as $host) { ?>

        <tr class="<?php echo odd_even(); ?>">
            <td><?php echo $host->getId(); ?></td>
            <td><a href="<?php echo get_url('plugin/mc_calendar/host_update/'.$host->id); ?>"><?php echo $host->getHostName(); ?></a></td>
            <td><?php echo $host->getHostEmail(); ?></td>            
            <td><?php echo $host->getHostPhone(); ?></td>            
            <td><?php echo $host->getHostAltPhone(); ?></td>            
             <td><a class="delete-event" href="<?php echo get_url('plugin/mc_calendar/delete_host/'.$host->id); ?>"><img src="<?php echo ICONS_PATH; ?>action-delete-16.png" alt="Delete" /></a></td>
        </tr>
        <?php } ?>
    </table>

<script>
  function onDeleteEventClick() {
    var question = "<?php echo __("Are you sure you want to delete this host?"); ?>";
    if (confirm(question))
      return true;
    else
      return false;
  }
   
  $("a.delete-event").click(onDeleteEventClick);  
</script>
