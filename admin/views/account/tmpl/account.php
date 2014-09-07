<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<form
	action="<?php echo JRoute::_('index.php?option=com_tsj&layout=edit&id='.(int) $this->item->account_id); ?>"
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

		//if($this->item->lic == '1') $this->form->setFieldAttribute('lic','value','1');
		//else $this->form->setFieldAttribute('lic','value','2');
		/*if ($field->name == 'jform[lic]')
		{

		$this->form->setFieldAttribute('lic','onclick','onclick()');
		if($this->item->lic == 1){
		$this->form->setFieldAttribute('lic','checked','checked');
		$this->form->setFieldAttribute('lic','value','1');
		} else {
		$this->form->setFieldAttribute('lic','checked','unchecked');
		$this->form->setFieldAttribute('lic','value','0');
		}
		//echo "<script>onclick();</script>";
		//$check = $this->form->getFieldAttribute('jform[lic]');
		//echo $this->form->getFieldAttribute('lic','value');
		}*/
		endforeach;
		?>

		<?php //if($this->item->lic == 1){ ?>
		<!--      <label for="lic12">lic</label><input type="checkbox" name="lic12" checked="checked" onClick="oncheck(this.form)" checked/> -->
		<?php //} else { ?>
		<!--      <label for="lic12">lic</label><input type="checkbox" name="lic12" onClick="oncheck(this)" /> -->
		<?php //} ?>


	</fieldset>

	<div>
		<input type="hidden" name="task" value="account.edit" />
        <input type="hidden" name="option" value="com_tsj" />
        <input type="hidden" name="account_id" value="<?php echo $this->item->account_id; ?>" />
        <input type="hidden" name="user_id" value="<?php echo $this->item->user_id; ?>" />
        <input type="hidden" name="address_id" value="<?php echo $this->item->address_id; ?>" />
        <input type="hidden" name="controller" value="account" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
