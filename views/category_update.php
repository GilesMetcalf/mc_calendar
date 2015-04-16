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

$edit_category = isset($category);
if (!$edit_category)
  $category = new CalendarCategory();

?>

<h1><?php echo $edit_category ? __('Edit the category') : __('A new category'); ?></h1>

<form action="<?php echo BASE_URL; ?>plugin/mc_calendar/update_category" method="post">
    <fieldset style="padding:0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Edit the category'); ?></legend>
            <table class="fieldset" cellspacing="0" cellpadding="0" border="0">
                <?php if ($edit_category): ?>
                    <input type="hidden" name="category[category_key]" value="<?php echo $category->getCategoryKey(); ?>" />
                <?php endif; ?>                
                <tr>
                    <td class="label"><label for="category-title"><?php echo __('Title'); ?></label></td>
                    <td class="field"><input type="text" id="category-title" name="category[cat_title]" class="textbox" value="<?php echo $category->getTitle(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="category-image"><?php echo __('Image URL'); ?></label></td>
                    <td class="field"><input type="text" id="category-cat_image" name="category[cat_image]" class="textbox" value="<?php echo $category->getCategoryImage(); ?>" /></td>
                </tr>
                <tr>
                    <td class="label"><label for="category-color"><?php echo __('Title bar colour'); ?></label></td>
                    <td class="field"><input type="text" id="category-color" name="category[cat_color]" class="textbox" value="<?php echo $category->getColor(); ?>" /></td>
                </tr>

 </table>
    </fieldset>
    <p class="buttons" align="right">
        <input class="button" type="submit" name="save" value="<?php echo __('Save'); ?>" /> or <a href="<?php echo get_url('plugin/mc_calendar/events'); ?>"><?php echo __('Cancel'); ?></a>
    </p>
</form>
