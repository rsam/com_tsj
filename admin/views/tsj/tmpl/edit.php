<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form
	action="<?php echo JRoute::_('index.php?option=com_tsj&layout=edit&id='.(int) $this->item->id); ?>"
	method="post" name="adminForm" id="tsj-form" class="form-validate">
	
   <fieldset class="adminform">
   <legend><?php echo JText::_( 'COM_TSJ_TSJ_DETAILS' ); ?></legend>
   <?php 
      foreach($this->form->getFieldset() as $field): 
         if (!$field->hidden): 
            echo $field->label;
         endif;

         echo $field->input; 
      endforeach; 
   ?>
   </fieldset>
   
   <div><input type="hidden" name="task" value="tsj.edit" /> <?php echo JHtml::_('form.token'); ?>
   </div>
</form>
