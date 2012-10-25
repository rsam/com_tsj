<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<tr>
	<th width="100%">
	<?php
   	// Вывод идентификатора пользователя (номера лицевого счета)
   	echo JText::_('<h2>Ваш идентификатор пользователя : ' . $this->username . '</h2><br>');
   	echo JText::_('<h2>Показания индивидуальных счетчиков воды</h2>');
   	
   	// вывод текста пользователя
   	$pref_text = $this->params->get( 'prefix_text', '');
   	echo JText::_($pref_text);
	?>
	</th>
</tr>
