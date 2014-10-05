<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');

// grid.sort - значит что по этому полю можно проводить сортировку
$listOrder   = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
?>
<tr>
	<th width="30">
        <?=JHtml::_('grid.sort', 'id', 'address_id', $listDirn, $listOrder); ?>
        <?php //echo JText::_('id'); ?>
    </th>
	<th width="20">
        <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
    </th>

	<th><?=JHtml::_('grid.sort', 'COM_TSJ_CITY_HEADING_NAME', 'city', $listDirn, $listOrder); ?>
	<?php //echo JText::_('COM_TSJ_CITY_HEADING_NAME'); ?></th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_STREET_HEADING_NAME', 'street', $listDirn, $listOrder); ?>
	<?php //echo JText::_('COM_TSJ_STREET_HEADING_NAME'); ?></th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_ADDRESS_HEADING_HOUSE', 'house', $listDirn, $listOrder); ?>
	<?php //echo JText::_('COM_TSJ_ADDRESS_HEADING_HOUSE'); ?></th>
	<th><?php echo JText::_('COM_TSJ_ADDRESS_HEADING_OFFICE'); ?></th>
</tr>
