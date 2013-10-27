<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<form
	action="<?php echo JRoute::_('index.php?option=com_tsj&layout=edit&id='.(int) $this->item->tarif_id); ?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="width-50 fltlft">
		<fieldset class="adminform">
			<legend>
			<?php echo JText::_( 'COM_TSJ_TARIF_DETAILS' ); ?>
			</legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getInput('tarif_id'); ?></li>

				<li><?php echo $this->form->getLabel('tarif_name_short'); ?> <?php echo $this->form->getInput('tarif_name_short'); ?>
				</li>

				<li><?php echo $this->form->getLabel('tarif_name'); ?> <?php echo $this->form->getInput('tarif_name'); ?>
				</li>

				<li><?php echo $this->form->getLabel('tarif'); ?> <?php echo $this->form->getInput('tarif'); ?>
				</li>

				<li><?php echo $this->form->getLabel('tarif_1'); ?> <?php echo $this->form->getInput('tarif_1'); ?>
				</li>

				<li><?php echo $this->form->getLabel('tarif_2'); ?> <?php echo $this->form->getInput('tarif_2'); ?>
				</li>
			</ul>
		</fieldset>
	</div>

	<div class="width-50 fltrt">
		<fieldset class="adminform">
			<legend>
			<?php echo JText::_( 'COM_TSJ_TARIF_LINK_DETAILS' ); ?>
			</legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('tarif_type'); ?> <?php echo $this->form->getInput('tarif_type'); ?>
				</li>
			</ul>
		</fieldset>
	</div>

	<div>
		<input type="hidden" name="task" value="tarif.edit" /> <input
			type="hidden" name="option" value="com_tsj" /> <input type="hidden"
			name="tarif_id" value="<?php echo $this->item->tarif_id; ?>" /> <input
			type="hidden" name="controller" value="tarif" />
			<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
