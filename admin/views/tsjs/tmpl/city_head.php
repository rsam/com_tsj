<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>
<tr>
	<th width="5"><?php echo JText::_('id'); ?></th>
	<th width="20"><input type="checkbox" name="toggle" value=""
		onclick="checkAll(<?php echo count($this->cityitems); ?>);" /></th>
	<th><?php
	echo JText::_('COM_TSJ_CITY_HEADING_NAME');
	?></th>
</tr>
