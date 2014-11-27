<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<th width="100%" align="left">
    <?php
	// Вывод идентификатора пользователя (номера лицевого счета)
    echo JText::_('ФИО пользователя: ' . $this->username . '<br>');    
    echo JText::_('Адрес: ' . $this->address . '<br>');    
    //echo JText::_('Задолженность по счетам: ' . $this-> . '<br>');    
	echo JText::_('Идентификатор пользователя : ' . $this->user . '<br><br>');    
	?>
	</th>
</tr>
<tr>
    <td width="100%" align="center">    
    <?
	echo JText::_('<h2>Показания индивидуальных счетчиков газа</h2>');    
	// вывод текста пользователя
	$pref_text = $this->params['gaz_prefix_text'];
	echo JText::_($pref_text);    
    ?>
    </td>
</tr>