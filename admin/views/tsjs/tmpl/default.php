<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
	method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
		<?php echo $this->loadTemplate('head');?>
		</thead>
		<tfoot>
		<?php echo $this->loadTemplate('foot');?>
		</tfoot>
		<tbody>
		<?php echo $this->loadTemplate('body');?>
		</tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="tsjs.setinnodb" /> <input
			type="hidden" name="boxchecked" value="0" /> <input type="hidden"
			name="view" value="" /> <input type="hidden" name="controller"
			value="tsjs" /> <input type="hidden" name="layout" value="tsjs" />
			<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
