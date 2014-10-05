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
        <?=JHtml::_('grid.sort', 'id', 'street_id', $listDirn, $listOrder); ?>
	</th>
	<th width="20">
        <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
    </th>
	<th>
        <?=JHtml::_('grid.sort', 'COM_TSJ_STREET_HEADING_NAME', 'street', $listDirn, $listOrder); ?>
	</th>
</tr>
