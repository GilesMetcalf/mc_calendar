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

<h1><?php echo __('All categories'); ?></h1>
    <table class="index" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <td><?php echo __('Key'); ?></td>
                <td><?php echo __('Title'); ?></td>
                <td><?php echo __('Image URL'); ?></td>
                <td><?php echo __('Colour'); ?></td>                
                <td><?php echo __('Delete'); ?></td>
            </tr>
        </thead>

        <?php foreach($categories as $category) { ?>

        <tr class="<?php echo odd_even(); ?>">
            <td><?php echo $category->getCategoryKey(); ?></td>
            <td><a href="<?php echo get_url('plugin/mc_calendar/category_update/'.$category->category_key); ?>"><?php echo $category->getTitle(); ?></a></td>
            <td><?php echo $category->getCategoryImage(); ?></td>            
            <td><?php echo $category->getColor(); ?></td>            
             <td><a class="delete-event" href="<?php echo get_url('plugin/mc_calendar/delete_category/'.$category->category_key); ?>"><img src="<?php echo ICONS_PATH; ?>action-delete-16.png" alt="Delete" /></a></td>
        </tr>
        <?php } ?>
    </table>

<script>
  function onDeleteEventClick() {
    var question = "<?php echo __("Are you sure you want to delete this category?"); ?>";
    if (confirm(question))
      return true;
    else
      return false;
  }
   
  $("a.delete-event").click(onDeleteEventClick);  
</script>
