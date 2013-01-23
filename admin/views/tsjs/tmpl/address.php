<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
jimport( 'joomla.html.pagination' );

$option = JRequest::getCmd('option');
$view = JRequest::getCmd('view');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
?>

<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
   method="post" name="adminForm" id="adminForm">
      <input  name="option" value="<?=$option?>" />
    	<input  name="view" value="<?=$view?>" />
    <input  name="filter_order" value="<?=$listOrder?>" />
    <input  name="filter_order_Dir" value="<?=$listDirn?>" />  
    
   <table class="adminlist">
      <thead><?php echo $this->loadTemplate('head');?></thead>
      <tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
      <tbody><?php echo $this->loadTemplate('body');?></tbody>
   </table>
   
   <div>
      <input type="hidden" name="option" value="com_tsj" />
      <input type="hidden" name="controller" value="address" />
      <input type="hidden" name="task" value="" />
      <input type="hidden" name="boxchecked" value="0" />
      <?php echo JHtml::_('form.token'); ?>
   </div>
   
</form>