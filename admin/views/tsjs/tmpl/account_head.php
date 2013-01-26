<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');

// grid.sort - значит что по этому полю можно проводить сортировку
$listOrder   = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
?>
<tr>
	<th width="30"><?=JHtml::_('grid.sort', 'id', 'account_id', $listDirn, $listOrder); ?></th>
	
	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->accountitems); ?>);" /></th>
		
   <th><?=JHtml::_('grid.sort', 'Номер<br>лиц. счета', 'account_num', $listDirn, $listOrder); ?></th>
   <th><?=JHtml::_('grid.sort', 'Город', 'city', $listDirn, $listOrder); ?></th>
   <th><?=JHtml::_('grid.sort', 'Улица', 'street', $listDirn, $listOrder); ?></th>
   <th width="40"><?php echo JText::_('Номер<br>дома'); ?></th>
   <th width="50"><?php echo JText::_('Номер<br>офиса/<br>квартиры'); ?></th>
   <th><?=JHtml::_('grid.sort', 'Ф.И.О.', 'name', $listDirn, $listOrder); ?></th>
   <th><?php echo JText::_('Телефон'); ?></th>
   <th width="50"><?php echo JText::_('Площадь<br>м2'); ?></th>
   <th width="20"><?php echo JText::_('cat'); ?></th>
   <th width="20"><?php echo JText::_('lic'); ?></th>
</tr>
