<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>
<tr>
	<th width="5"><?php echo JText::_('id'); ?></th>
	
	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->accountitems); ?>);" /></th>
		
   <th><?php echo JText::_('Номер<br>лиц. счета'); ?></th>
   <th><?php echo JText::_('Город'); ?></th>
   <th><?php echo JText::_('Улица'); ?></th>
   <th width="40"><?php echo JText::_('Номер<br>дома'); ?></th>
   <th width="50"><?php echo JText::_('Номер<br>офиса/<br>квартиры'); ?></th>
   <th><?php echo JText::_('Ф.И.О.'); ?></th>
   <th><?php echo JText::_('Телефон'); ?></th>
   <th width="50"><?php echo JText::_('Площадь<br>м2'); ?></th>
   <th width="20"><?php echo JText::_('cat'); ?></th>
   <th width="20"><?php echo JText::_('lic'); ?></th>
</tr>
