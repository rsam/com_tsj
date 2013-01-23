<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>
<tr>
	<th width="5"><?php echo JText::_('id'); ?></th>
	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->addressitems); ?>);" /></th>
		
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_CITY_HEADING_NAME', 'city', $listDirn, $listOrder); ?><?php //echo JText::_('COM_TSJ_CITY_HEADING_NAME'); ?></th>
	<th><?php echo JText::_('COM_TSJ_STREET_HEADING_NAME'); ?></th>
	<th><?php echo JText::_('COM_TSJ_ADDRESS_HEADING_HOUSE'); ?></th>
	<th><?php echo JText::_('COM_TSJ_ADDRESS_HEADING_OFFICE'); ?></th>
</tr>
