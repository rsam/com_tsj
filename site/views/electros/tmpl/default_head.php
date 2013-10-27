<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<tr>
	<th width="100%"><?php
	// Вывод идентификатора пользователя (номера лицевого счета)
	echo JText::_('<h2>Ваш идентификатор пользователя : ' . $this->user . '</h2><br>');
	echo JText::_('<h2>Показания индивидуальных счетчиков электроэнергии</h2>');

	// вывод текста пользователя
	$pref_text = $this->params['electro_prefix_text'];
	echo JText::_($pref_text);
	?>
	</th>
</tr>
