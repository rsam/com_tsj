<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');

?>
<tr>
	<td colspan="2">
		<table width='100%'>
			<tr>
				<td width='50%' class='adminform' valign='top'>

					<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
						method="post" name="adminForm" id="adminForm">
						<?php
						if (JRequest::getVar($this->dbuser, "MySQLi") != "InnoDB") {
							echo JText::_('COM_TSJ_BASE_NOT_INNODB');
							?>
						<!-- set InnoDB form -->
						<input id="submit" type="submit" name="submit"
							value="Change users table format to InnoDB" />
							<?php
						}
						?>
						<div class='clr'></div>

						<div>
							<input type="hidden" name="task" value="tsjs.setinnodb" /> <input
								type="hidden" name="boxchecked" value="0" /> <input
								type="hidden" name="view" value="tsjs" /> <input type="hidden"
								name="controller" value="tsjs" /> <input type="hidden"
								name="layout" value="tsjs" />
								<?php echo JHtml::_('form.token'); ?>
						</div>
					</form> <!-- set main control form --> <br>
					<form action="<?php echo JRoute::_('index.php?option=com_tsj'); ?>"
						method="post" name="configForm" id="configForm">

						<table style="width: 100%;">
							<tr>
								<td style="float: right;"><?php 
								$state_water[] = JHTML::_('select.option', '1', 'Включить');
								$state_water[] = JHTML::_('select.option', '2', 'Выключить');
								echo JText::_("Опция сдачи показаний счетчиков воды: ");?>
								</td>
								<td><?php 
								if($this->param['water_on'] == '1'){
									echo JHTML::_('select.radiolist', $state_water, $name='water', $attribs = null, $key = 'value', $text = 'text', $selected = '1', $idtag = false, $translate = false);
								}else
								echo JHTML::_('select.radiolist', $state_water, $name='water', $attribs = null, $key = 'value', $text = 'text', $selected = '2', $idtag = false, $translate = false);
								?>
								</td>
							</tr>
							<tr>
								<td style="float: right;"><?php 
								$state_gaz[] = JHTML::_('select.option', '1', 'Включить');
								$state_gaz[] = JHTML::_('select.option', '2', 'Выключить');
								echo JText::_("Опция сдачи показаний счетчиков газа: ");?>
								</td>
								<td><?php 
								if($this->param['gaz_on'] == '1')
								echo JHTML::_('select.radiolist', $state_gaz, $name='gaz', $attribs = null, $key = 'value', $text = 'text', $selected = '1', $idtag = false, $translate = false);
								else
								echo JHTML::_('select.radiolist', $state_gaz, $name='gaz', $attribs = null, $key = 'value', $text = 'text', $selected = '2', $idtag = false, $translate = false);
								?>
								</td>
							</tr>
							<tr>
								<td style="float: right;"><?php 
								$state_electro[] = JHTML::_('select.option', '1', 'Включить');
								$state_electro[] = JHTML::_('select.option', '2', 'Выключить');
								echo JText::_("Опция сдачи показаний счетчиков электроэнергии: ");?>
								</td>
								<td><?php 
								if($this->param['electro_on'] == '1')
								echo JHTML::_('select.radiolist', $state_electro, $name='electro', $attribs = null, $key = 'value', $text = 'text', $selected = '1', $idtag = false, $translate = false);
								else
								echo JHTML::_('select.radiolist', $state_electro, $name='electro', $attribs = null, $key = 'value', $text = 'text', $selected = '2', $idtag = false, $translate = false);
								?>
								</td>
							</tr>
							<tr>
								<td style="float: right;"><input id="setconfig" type="submit"
									name="setconfig" value="Применить" />
								</td>
							</tr>
						</table>

						<div>
							<input type="hidden" name="task" value="tsjs.setconfig" /> <input
								type="hidden" name="boxchecked" value="0" /> <input
								type="hidden" name="view" value="tsjs" /> <input type="hidden"
								name="controller" value="tsjs" /> <input type="hidden"
								name="layout" value="tsjs" />

								<?php echo JHtml::_('form.token'); ?>
						</div>
				
				</td>
				<td valign='top' width='50%' style='padding: 0px 0px 0px 0px'>
					<table class='adminlist'>
						<tr>
							<td colspan='2'>
								<p>
								<?php echo JText::_('COM_TSJ_MAIN')?>
								</p>
							</td>
						</tr>
						<tr>
							<td width='40%'><?php echo JText::_('Version'); ?></td>
							<td width='60%'><?php echo '2.0.0'; ?></td>
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
							<td><?php echo JText::_('COM_TSJ_DONATE'); ?><br> <a
								href='http://www.webmoney.ru/' target='_blank'>WMZ:Z252490757879</a><br>
								<a href='http://www.webmoney.ru/' target='_blank'>WMR:R159357132082</a><br>
								<?php echo JText::_('COM_TSJ_DONATE1') ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
