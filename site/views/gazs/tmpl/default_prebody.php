<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Подключаем helper.php
require_once(dirname(JPATH_COMPONENT).'/com_tsj/helpers/helper.php');

// Установка живучести сессии
JHtml::_('behavior.keepalive');
// Подключение скриптов проверки формы
JHtml::_('behavior.formvalidation');
// Подключение скриптов для тулбара
//JHtml::_('behavior.tooltip');
?>

<tr>
	<td><?php

	// Вывод информационных сообщений
	$delta = abs($this->params['gaz_startDay'] - $this->params['gaz_stopDay']);
	if( ($delta > 1 ) && ($delta < 30) )
	{
		//echo abs($this->params['gaz_startDay'] - $this->params['gaz_stopDay']);
		echo '<h3>Внимание!!! Вы можете ввести показания счетчиков только c '.
		$this->params['gaz_startDay'] .' по ' . $this->params['gaz_stopDay'] .
   			' число включительно каждого месяца.</h3>';
	}

	//echo '<h3>При вводе показаний повторно, предыдущие показания будут заменены вновь введенными.</h3>';

	// Присвоение переменным серийных номеров счетчиков
	for($i = 1; $i <= $this->dataofsn->counts; $i++)
	{
		$csnp[$i] = $this->dataofsn->{'ser_num_p'.$i};
	}

	// Присвоение переменным названий точек установки
	$name[1] = $this->dataofsn->gaz_name_1;
	$name[2] = $this->dataofsn->gaz_name_2;
	$name[3] = $this->dataofsn->gaz_name_3;

	//$form = $this->get('Check_Gaz');
	// Получить текущую дату
	$date = date("Y-m-d");
	//$date_month = date("Y-m");
	$day = date("d");

	// Проверка на допущение ввода показаний по диапазону дат и повтора ввода показаний
	$form = MyHelper::Check_Gaz($test, $date, $day);
	if ($form > 0) :

	// Проверка на серийные номера. Если все серийные номера заполнены, то выводим форму
	if(( ($this->dataofsn->counts == 1) && ($csnp[1] != NULL) ) ||
	( ($this->dataofsn->counts == 2) && ($csnp[1] != NULL) && ($csnp[2] != NULL) ) ||
	( ($this->dataofsn->counts == 3) && ($csnp[1] != NULL) && ($csnp[2] != NULL) && ($csnp[3] != NULL)) ) :
	?>
		<form class="form-validate" name="gazs" id="gazs"
			action="<?php echo JRoute::_('index.php'); ?>" method="post">
			<fieldset>
				<!--<legend>Ввод показаний индивидуальных счетчиков газа</legend>-->

				<table BORDER=0 COLS=2>

				<?php
				// Вывод полей формы для ввода показаний соответствующих количеству точек установки
				for($i = 1; $i <= $this->dataofsn->counts; $i++)
				{
					?>
					<tr>
						<th align=left>Место установки <?=$i?>: <?=$name[$i]?></th>
						<?php if($i == 1) echo '<th>(например: 10 или 3.21 или 0.0512)</th>';
						else echo '<th></th>';
						?>
					</tr>
					<tr>
						<td align=right>Показания счетчика №<?=$this->dataofsn->{'ser_num_p'.$i}?></td>
						<td align=left><?php echo $this->form->getInput('gaz'.$i); ?><FONT
							COLOR="#FF0000">*</FONT></td>
					</tr>
					<tr>
						<td align=left></td>
						<td align=right></td>
					</tr>
					<?php }?>

					<tr>
						<td align=left><input type="hidden" name="option" value="com_tsj" />
							<input type="hidden" name="task" value="gazs.submit" /> <!--<button class="back_button" id="submit" name="submit" type="submit" value="Передать показания"></button>-->
							<input id="submit" name="submit" type="submit"
							value="Передать показания" /> <?php echo JHtml::_('form.token'); ?>
						</td>
						<td align=right></td>
					</tr>
					<tr>
					</tr>
				</table>

			</fieldset>
			<div class="clr"></div>

		</form> <br /> <?php
		else :
		// если серийные номера не заполнены, то вывод ссылки на страницу заполения серийных номеров
		$linksn = $this->params['gaz_linksn'];
		if(!empty($linksn))
		{
			echo '<h3>Перед началом ввода показаний <a href=';
			echo JURI::root() . $linksn;
			echo '>введите серийные номера всех счетчиков</a></h3>';
		}

		endif;
		endif;

		?>
	</td>
</tr>
