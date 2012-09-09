<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
	<tr>
		<td>
		<?php
            $state[] = JHTML::_('select.option', '1', 'Включить');
            $state[] = JHTML::_('select.option', '2', 'Выключить');
            echo JHTML::_('select.radiolist', $state, $name='Radio', $attribs = null, $key = 'value', $text = 'text', $selected = null, $idtag = false, $translate = false); 
        ?>
		</td>
		<td>
			<?php echo JText::_('Показания индивидуальных счетчиков воды'); ?>
		</td>
	</tr>