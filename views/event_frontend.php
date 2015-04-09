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

/* Format and display data */
?>
  
<div class="event" id="event<?=$id?>">
<h3><?=$date_from?><?php if (!empty($date_to)) echo " ".__("to")." $date_to"; ?>: <?=$title?></h3>
<p><?=$content?></p>
<?php if ($show_author): ?>
<p class="info"><?php echo __("Posted by").": $author"; ?></p>
<?php endif; ?>  
</div>    
