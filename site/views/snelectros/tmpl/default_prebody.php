<script Language="JavaScript">
<!--
function check_form_electro(value)
{
   if(value == 2)
   {
	   document.getElementById('te2').style.display="";
	   document.getElementById('sne2').style.display="";
	   document.getElementById('de2').style.display="";
	   document.getElementById('psne2').style.display="";
	   document.getElementById('pde2').style.display="";
	   document.snelectros.snelectros_ename2.disabled = false;
	   document.snelectros.snelectros_ename2.style.display="";
	   document.snelectros.snelectros_snelectro2.disabled = false;
	   document.snelectros.snelectros_snelectro2.style.display="";
      document.snelectros.snelectros_dateelectro2.disabled = false;
      document.snelectros.snelectros_dateelectro2.style.display="";

      document.getElementById('te3').style.display="none";
      document.getElementById('sne3').style.display="none";
      document.getElementById('de3').style.display="none";
      document.getElementById('psne3').style.display="none";
      document.getElementById('pde3').style.display="none";
      document.snelectros.snelectros_snelectro3.disabled = true;
      document.snelectros.snelectros_snelectro3.style.display="none";
      document.snelectros.snelectros_dateelectro3.disabled = true;
      document.snelectros.snelectros_dateelectro3.style.display="none";
      document.snelectros.snelectros_ename3.disabled = true;
      document.snelectros.snelectros_ename3.style.display="none";
   }
   else if(value == 3)
   {
	   document.getElementById('te2').style.display="";
	   document.getElementById('sne2').style.display="";
	   document.getElementById('de2').style.display="";
	   document.getElementById('psne2').style.display="";
	   document.getElementById('pde2').style.display="";
    	document.snelectros.snelectros_snelectro2.disabled = false;
    	document.snelectros.snelectros_snelectro2.style.display="";
      document.snelectros.snelectros_dateelectro2.disabled = false;
      document.snelectros.snelectros_dateelectro2.style.display="";
      document.snelectros.snelectros_ename2.disabled = false;
      document.snelectros.snelectros_ename2.style.display="";
      
      document.getElementById('te3').style.display="";
      document.getElementById('sne3').style.display="";
      document.getElementById('de3').style.display="";
      document.getElementById('psne3').style.display="";
      document.getElementById('pde3').style.display="";
      document.snelectros.snelectros_snelectro3.disabled = false;
      document.snelectros.snelectros_snelectro3.style.display="";
      document.snelectros.snelectros_dateelectro3.disabled = false;
      document.snelectros.snelectros_dateelectro3.style.display="";
      document.snelectros.snelectros_ename3.disabled = false;
      document.snelectros.snelectros_ename3.style.display="";
   }
   else
   {
	   document.getElementById('te2').style.display="none";
	   document.getElementById('sne2').style.display="none";
	   document.getElementById('de2').style.display="none";
	   document.getElementById('psne2').style.display="none";
	   document.getElementById('pde2').style.display="none";
	   document.snelectros.snelectros_snelectro2.disabled = true;
	   document.snelectros.snelectros_snelectro2.style.display="none";
	   document.snelectros.snelectros_dateelectro2.disabled = true;
	   document.snelectros.snelectros_dateelectro2.style.display="none";
      document.snelectros.snelectros_ename2.disabled = true;
      document.snelectros.snelectros_ename2.style.display="none";

      document.getElementById('te3').style.display="none";
      document.getElementById('sne3').style.display="none";
      document.getElementById('de3').style.display="none";
      document.getElementById('psne3').style.display="none";
      document.getElementById('pde3').style.display="none";
      document.snelectros.snelectros_snelectro3.disabled = true;
      document.snelectros.snelectros_snelectro3.style.display="none";
      document.snelectros.snelectros_dateelectro3.disabled = true;
      document.snelectros.snelectros_dateelectro3.style.display="none";
      document.snelectros.snelectros_ename3.disabled = true;
      document.snelectros.snelectros_ename3.style.display="none";
   }
}

function verify()
{
	var answer = confirm("Вы уверены что хотите добавить новую запись? Это следует делать если вы изменяете серийные номера счётчиков, дату следующей поверки или количество мест установки.");

	if (answer){
		return true;
	} else {
		return false;
	}
}

-->
</script>

<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Установка живучести сессии
JHtml::_('behavior.keepalive');
// Подключение скриптов проверки формы
JHtml::_('behavior.formvalidation');
// Подключение скриптов для тулбара
//JHtml::_('behavior.tooltip');
?>

<tr>
	<td><?php
	if($this->dataofsn != NULL)
	{
		foreach ( $this->dataofsn as $row )
		{
			for($i = 1; $i <= $row->counts; $i++)
			{
				$csnp[$i] = $row->{'ser_num_p'.$i};

				$cdatep[$i] = $row->{'date_in_pp'.$i};

				$name[$i] = $row->{'electro_name_'.$i};
			}
		}
	}

	if($row->counts == 0) $this->countofpoint = 1;
	else $this->countofpoint = $row->counts;

	$date = date("Y-m-d");
	//$date_month = date("Y-m");
	$day = date("d");
	?>

		<form class="form-validate" name="snelectros" id="snelectros"
			action="<?php echo JRoute::_('index.php'); ?>" method="post"
			<?php if(!empty($this->dataofsn)) echo 'onSubmit="return verify()"'; ?>>
			<fieldset>
				<!--<legend>Ввод показаний индивидуальных счетчиков воды</legend>-->

				<TABLE BORDER=0 COLS=2>
					<TR>
						<TH align=left>Количество мест установки :</TH>
					</TR>


					<TR>
					<?php if (($this->countofpoint == '1') || ($this->countofpoint == NULL)) : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(1)" value="1" CHECKED />1
							место установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(1)" value="1" />1 место
							установки</TD>
							<?php endif; ?>
					</TR>
					<TR>
					<?php if ($this->countofpoint == '2') : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(2)" value="2" CHECKED />2
							места установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(2)" value="2" />2 места
							установки</TD>
							<?php endif; ?>
					</TR>
					<TR>
					<?php if ($this->countofpoint == '3') : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(3)" value="3" CHECKED />3
							места установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_electro(3)" value="3" />3 места
							установки</TD>
							<?php endif; ?>
					</TR>

				</TABLE>
				<BR> <BR>

				<table BORDER=0 COLS=2>
				<?php
				$counts = 3;
				for($i = 1; $i <= $counts; $i++)
				{
					?>

					<tr>
						<th align=left id="te<?=$i ?>">Место установки <?=$i ?>: <?php echo $this->form->getInput('ename'.$i, null, $name[$i]); ?>
						</th>
						<th></th>
					</tr>
					<tr>
						<td align=right id="sne<?=$i ?>">Серийный номер счетчика :</td>
						<td align=left id="psne<?=$i ?>"><?php echo $this->form->getInput('snelectro'.$i, null, $csnp[$i]); ?><FONT
							COLOR="#FF0000">*</FONT></td>
					</tr>
					<tr>
						<td align=right id="de<?=$i ?>">Дата следующей поверки счетчика :</td>
						<td align=left id="pde<?=$i ?>"><?php echo $this->form->getInput('dateelectro'.$i, null, $cdatep[$i]); ?><FONT
							COLOR="#FF0000">*</FONT></td>
					</tr>
					<tr>
						<td align=left></td>
						<td align=right></td>
					</tr>
					<?php
				}
				?>

					<tr>
						<td align=left><input type="hidden" name="option" value="com_tsj" />
							<input type="hidden" name="task" value="snelectros.submit" /> <!--<button class="back_button" id="submit" name="submit" type="submit" value="Передать показания"></button>-->
							<input id="submit" name="submit" type="submit"
							value="Передать данные" /> <?php echo JHtml::_('form.token'); ?>
						</td>
						<td align=right></td>
					</tr>
					<tr>
					</tr>
				</table>

			</fieldset>

			<div class="clr"></div>
		</form> <br> <?php
   	echo "<script>check_form_electro(" . $row->counts . ");</script>";
   	?>
	</td>
</tr>
