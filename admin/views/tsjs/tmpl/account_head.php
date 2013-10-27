<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');

// grid.sort - значит что по этому полю можно проводить сортировку
$listOrder   = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
?>
<tr>
	<th width="30"><?=JHtml::_('grid.sort', 'id', 'account_id', $listDirn, $listOrder); ?>
	</th>

	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->accountitems); ?>);" /></th>

	<th><?=JHtml::_('grid.sort', 'COM_TSJ_ACCOUNT_NAME1', 'account_num', $listDirn, $listOrder); ?>
	</th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_CITY_HEADING_NAME', 'city', $listDirn, $listOrder); ?>
	</th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_STREET_HEADING_NAME', 'street', $listDirn, $listOrder); ?>
	</th>
	<th width="40"><?php echo JText::_('COM_TSJ_ADDRESS_HEADING_HOUSE1'); ?>
	</th>
	<th width="50"><?php echo JText::_('COM_TSJ_ADDRESS_HEADING_OFFICE1'); ?>
	</th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_FIO', 'name', $listDirn, $listOrder); ?>
	</th>
	<th><?php echo JText::_('COM_TSJ_TEL_NAME1'); ?></th>
	<th width="50"><?php echo JText::_('COM_TSJ_OFFICE_SQUARE1'); ?></th>
	<th width="20"><?php echo JText::_('COM_TSJ_CATEGORY_NAME1'); ?></th>
	<th width="20"><?php echo JText::_('COM_TSJ_LIC_NAME1'); ?></th>
</tr>
