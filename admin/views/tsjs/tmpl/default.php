<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
if (version_compare(JPlatform::RELEASE, '12', '<'))
{
	JHtml::_('behavior.tooltip');
}
else
{
	JHtml::_('bootstrap.tooltip');
	JHtml::_('formbehavior.chosen', 'select');	
}
JHtml::_('behavior.multiselect');
?>
	<table width=100% class="table table-striped adminlist" id="defaultlist">
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
