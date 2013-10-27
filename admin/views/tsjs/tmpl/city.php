<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');

$option = JRequest::getCmd('option');
$view = JRequest::getCmd('view');

//поле для текущей сортировки
$listOrder = $this->escape($this->state->get('list.ordering'));
//направление сортировки
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
	method="post" name="adminForm" id="adminForm">

	<table class="adminlist">
		<thead>
		<?php echo $this->loadTemplate('head');?>
		</thead>
		<tbody>
		<?php echo $this->loadTemplate('body');?>
		</tbody>
		<tfoot>
		<?php echo $this->loadTemplate('foot');?>
		</tfoot>
	</table>

	<div>
		<input type="hidden" name="filter_order"
			value="<?php echo $listOrder; ?>" /> <input type="hidden"
			name="filter_order_Dir" value="<?php echo $listDirn; ?>" /> <input
			type="hidden" name="view" value="<?=$view?>" /> <input type="hidden"
			name="option" value="<?=$option?>" /> <input type="hidden"
			name="controller" value="tsjs" /> <input type="hidden" name="layout"
			value="city" /> <input type="hidden" name="task" value="" /> <input
			type="hidden" name="boxchecked" value="0" />
			<?php echo JHtml::_('form.token'); ?>
	</div>

</form>
