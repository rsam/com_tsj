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
        <?=JHtml::_('grid.sort', 'id', 'tarif_id', $listDirn, $listOrder); ?>
	</th>
	<th width="20">
        <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
    </th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_TARIF_NAME_SHORT', 'tarif_name_short', $listDirn, $listOrder); ?>
	</th>
	<th><?=JHtml::_('grid.sort', 'COM_TSJ_TARIF_NAME', 'tarif_name', $listDirn, $listOrder); ?>
	</th>
	<th><?php echo JText::_('COM_TSJ_TARIF'); ?></th>
	<th><?php echo JText::_('COM_TSJ_TARIF_1'); ?></th>
	<th><?php echo JText::_('COM_TSJ_TARIF_2'); ?></th>
	<th><?php echo JText::_('COM_TSJ_TARIF_LINK_TYPE'); ?></th>
</tr>
