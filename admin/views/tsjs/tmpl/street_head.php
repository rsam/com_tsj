<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>
<tr>
	<th width="5"><?php echo JText::_('id'); ?></th>
	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->streetitems); ?>);" /></th>
	<th><?php
   	//echo JHTML::_( 'grid.sort', COM_TSJ_STREET_HEADING_NAME, 'street', $this->sortDirection, $this->sortColumn);
   	echo JText::_('COM_TSJ_STREET_HEADING_NAME');
	?></th>
</tr>
