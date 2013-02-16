<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
	<tr>
		<td colspan="2">
		<?php 
			echo JText::_('Для заполнения базы данных собственников помещений, выберите соответствующую закладку.<br>');
			echo JText::_('Или воспользуйтесь функцией импорта (кнопка "Import") из CSV файла.');
            //$state[] = JHTML::_('select.option', '1', 'Включить');
            //$state[] = JHTML::_('select.option', '2', 'Выключить');
            //echo JHTML::_('select.radiolist', $state, $name='Radio', $attribs = null, $key = 'value', $text = 'text', $selected = null, $idtag = false, $translate = false); 
        ?>
		</td>
	</tr>