<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<td colspan="2">

	<table width='100%'>
		<tr>
			<td width='50%' class='adminform' valign='top'>
				<?php 
					if (JRequest::getVar($dbuser, "MySQLi") != "InnoDB") {
						echo 'Внимание!!! Таблица users базы данных не в формате InnoDB<br>
						Для работы компонента пожалуйста измените формат таблицы users базы данных.<br>
						Это можно сделать через phpMyAdmin.';
					}
				?>
			<div class='clr'></div>
			</td>
			<td valign='top' width='50%' style='padding: 0px 0px 0px 0px'>
			<table class='adminlist'>
				<tr>
					<td colspan='2'>
					<p><?php echo JText::_('Компонент УК и ТСЖ для CMS Joomla 2.5')?></p>
					</td>
				</tr>
				<tr>
					<td width='40%'><?php echo JText::_('Version'); ?></td>
					<td width='60%'><?php echo '1.3.0'; ?></td>
				</tr>
				<tr>
					<td><?php echo JText::_('Copyright'); ?></td>
					<td><a href='https://github.com/rsam/com_tsj' target='_blank'>&copy;
					2012 Shibin Roman </a></td>
				</tr>
				<tr>
					<td><?php echo JText::_('License'); ?></td>
					<td><a href='http://www.gnu.org/licenses/gpl-3.0.html'
						target='_blank'>GNU/GPL v3</a></td>
				</tr>
				<tr>
					<td><?php echo JText::_('Donate'); ?></td>
					<td>Для поддержки развития компонента Вы можете
					   сделать добровольное пожертвование денежных средств.<br>
					   <a href='http://www.webmoney.ru/'
						target='_blank'>WMZ:Z252490757879</a><br>
						<a href='http://www.webmoney.ru/'
                  target='_blank'>WMR:R159357132082</a><br>
                  Спасибо за поддержку.</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>

	</td>
</tr>
