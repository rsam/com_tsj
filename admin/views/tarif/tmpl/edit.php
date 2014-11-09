<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>


<form
	action="<?php echo JRoute::_('index.php?option=com_tsj&layout=edit&id='.(int) $this->item->tarif_id); ?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<fieldset class="adminform">
		<legend>
		<?php echo JText::_( 'COM_TSJ_TSJ_DETAILS' ); ?>
		</legend>
		<?php
		foreach($this->form->getFieldset() as $field):
		if (!$field->hidden):
		echo $field->label;
		endif;

		echo $field->input;
		endforeach;
		?>
	</fieldset>

	<div>
		<input type="hidden" name="task" value="tarif.edit" />
        <input type="hidden" name="option" value="com_tsj" />
        <input type="hidden" name="tarif_id" value="<?php echo $this->item->tarif_id; ?>" />
        <input type="hidden" name="controller" value="tarif" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>    
