<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_tsj
 * @copyright	Copyright (C) 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 3; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include the HTML helpers.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

?>
<script type="text/javascript">
Joomla.submitbutton = function(task) {
	if (task == '') {
		return false;
	} else {
		var isValid = true;
		var action = task.split('.');
		if (action[1] != 'cancel' && action[1] != 'close') {
			var forms = $$('form.form-validate');
			for ( var i = 0; i < forms.length; i++) {
				if (!document.formvalidator.isValid(forms[i])) {
					isValid = false;
					break;
				}
			}
		}

		if (isValid) {
			Joomla.submitform(task);
			return true;
		} else {
			alert(Joomla.JText._('COM_TSJ_TSJ_ERROR_UNACCEPTABLE',
					'Some values are unacceptable'));
			return false;
		}
	}
}
	//Joomla.submitbutton = function(task)
	//{
	//	if (task == 'wconfig.cancel' || document.formvalidator.isValid(document.id('wconfig-form'))) {
	//		Joomla.submitform(task, document.getElementById('wconfig-form'));
	//	}
	//}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
	method="post" name="adminForm" id="wconfig-form" autocomplete="off"
	class="form-validate">
	
	<fieldset>
	
		<div class="fltrt">
			<button type="button"
				onclick="Joomla.submitform('wconfig.save', this.form);window.top.setTimeout('window.parent.SqueezeBox.close()', 100);">
				<?php echo JText::_('JSAVE');?>
			</button>
			
			<button type="button" onclick="window.parent.SqueezeBox.close();">
			<?php echo JText::_('JCANCEL');?>
			</button>
		</div>
		
		<div class="configuration">
		<?php echo JText::_('Настройки компонента COM_TSJ') ?>
		</div>
		
	</fieldset>

	<?php
	echo JHtml::_('tabs.start', 'config-tabs-'.$this->component->option.'_configuration', array('useCookie'=>1));
	$fieldSets = $this->form->getFieldsets();

	foreach ($fieldSets as $name => $fieldSet) :
		$label = empty($fieldSet->label) ? 'COM_TSJ_'.$name.'_FIELDSET_LABEL' : $fieldSet->label;
	
		echo JHtml::_('tabs.panel', JText::_($label), 'publishing-details');
	
		if (isset($fieldSet->description) && !empty($fieldSet->description)) :
			echo '<p class="tab-description">'.JText::_($fieldSet->description).'</p>';
		endif;
		?>
		
		<ul class="config-option-list">

		<?php
		if($name == 'waterparams'){
			echo "<h3>Для того чтобы форма ввода показаний счетчиков была доступна всегда необходимо:<br>
				 установить 'День начала сдачи показаний' = 1, 'День окончания сдачи показаний' = 31.</h3>";
		}
		
		foreach ($this->form->getFieldset($name) as $field):
		?>
		
			<li>
			<?php 
			if (!$field->hidden) :
				echo $field->label;
			endif;
			
			echo $field->input;
			?>
			</li>
			
		<?php
		endforeach;
		?>
		</ul>
	
		<div class="clr"></div>
	<?php
	endforeach;

	echo JHtml::_('tabs.end');
	?>

	<div>
		<input type="hidden" name="id" value="<?php echo $this->component->id;?>" />
		<input type="hidden"	name="component" value="<?php echo $this->component->option;?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	
</form>
