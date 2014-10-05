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

$option = JRequest::getCmd('option');
$view = JRequest::getCmd('view');

//поле для текущей сортировки
$listOrder = $this->escape($this->state->get('list.ordering'));
//направление сортировки
$listDirn = $this->escape($this->state->get('list.direction'));

?>

<form action="<?php echo JRoute::_('index.php?option=com_tsj&view=account'); ?>"
	method="post" name="adminForm" id="adminForm">
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		<table width=100% class="table table-striped adminlist" id="accountList">
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
	</div>
	<div>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <input type="hidden" name="view" value="tsjs" />
        <input type="hidden" name="option" value="<?=$option?>" />
        <input type="hidden" name="controller" value="tsjs" />
        <input type="hidden" name="layout" value="account" />
        <input type="hidden" name="task" value="account" />
        <input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

</form>
