<script Language="JavaScript">
<!--
function check_form_gaz(value)
{
   if(value == 2)
   {
	   document.getElementById('tg2').style.display="";
	   document.getElementById('sng2').style.display="";
	   document.getElementById('dg2').style.display="";
	   document.getElementById('psng2').style.display="";
	   document.getElementById('pdg2').style.display="";
	   document.sngazs.sngazs_gname2.disabled = false;
	   document.sngazs.sngazs_gname2.style.display="";
	   document.sngazs.sngazs_sngaz2.disabled = false;
	   document.sngazs.sngazs_sngaz2.style.display="";
      document.sngazs.sngazs_dategaz2.disabled = false;
      document.sngazs.sngazs_dategaz2.style.display="";

      document.getElementById('tg3').style.display="none";
      document.getElementById('sng3').style.display="none";
      document.getElementById('dg3').style.display="none";
      document.getElementById('psng3').style.display="none";
      document.getElementById('pdg3').style.display="none";
      document.sngazs.sngazs_sngaz3.disabled = true;
      document.sngazs.sngazs_sngaz3.style.display="none";
      document.sngazs.sngazs_dategaz3.disabled = true;
      document.sngazs.sngazs_dategaz3.style.display="none";
      document.sngazs.sngazs_gname3.disabled = true;
      document.sngazs.sngazs_gname3.style.display="none";
   }
   else if(value == 3)
   {
	   document.getElementById('tg2').style.display="";
	   document.getElementById('sng2').style.display="";
	   document.getElementById('dg2').style.display="";
	   document.getElementById('psng2').style.display="";
	   document.getElementById('pdg2').style.display="";
    	document.sngazs.sngazs_sngaz2.disabled = false;
    	document.sngazs.sngazs_sngaz2.style.display="";
      document.sngazs.sngazs_dategaz2.disabled = false;
      document.sngazs.sngazs_dategaz2.style.display="";
      document.sngazs.sngazs_gname2.disabled = false;
      document.sngazs.sngazs_gname2.style.display="";
      
      document.getElementById('tg3').style.display="";
      document.getElementById('sng3').style.display="";
      document.getElementById('dg3').style.display="";
      document.getElementById('psng3').style.display="";
      document.getElementById('pdg3').style.display="";
      document.sngazs.sngazs_sngaz3.disabled = false;
      document.sngazs.sngazs_sngaz3.style.display="";
      document.sngazs.sngazs_dategaz3.disabled = false;
      document.sngazs.sngazs_dategaz3.style.display="";
      document.sngazs.sngazs_gname3.disabled = false;
      document.sngazs.sngazs_gname3.style.display="";
   }
   else
   {
	   document.getElementById('tg2').style.display="none";
	   document.getElementById('sng2').style.display="none";
	   document.getElementById('dg2').style.display="none";
	   document.getElementById('psng2').style.display="none";
	   document.getElementById('pdg2').style.display="none";
	   document.sngazs.sngazs_sngaz2.disabled = true;
	   document.sngazs.sngazs_sngaz2.style.display="none";
	   document.sngazs.sngazs_dategaz2.disabled = true;
	   document.sngazs.sngazs_dategaz2.style.display="none";
      document.sngazs.sngazs_gname2.disabled = true;
      document.sngazs.sngazs_gname2.style.display="none";

      document.getElementById('tg3').style.display="none";
      document.getElementById('sng3').style.display="none";
      document.getElementById('dg3').style.display="none";
      document.getElementById('psng3').style.display="none";
      document.getElementById('pdg3').style.display="none";
      document.sngazs.sngazs_sngaz3.disabled = true;
      document.sngazs.sngazs_sngaz3.style.display="none";
      document.sngazs.sngazs_dategaz3.disabled = true;
      document.sngazs.sngazs_dategaz3.style.display="none";
      document.sngazs.sngazs_gname3.disabled = true;
      document.sngazs.sngazs_gname3.style.display="none";
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

				$name[$i] = $row->{'gaz_name_'.$i};
			}
		}
	}

	if($row->counts == 0) $this->countofpoint = 1;
	else $this->countofpoint = $row->counts;

	$date = date("Y-m-d");
	//$date_month = date("Y-m");
	$day = date("d");
	?>

		<form class="form-validate" name="sngazs" id="sngazs"
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
							id="countpoint" onClick="check_form_gaz(1)" value="1" CHECKED />1
							место установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_gaz(1)" value="1" />1 место
							установки</TD>
							<?php endif; ?>
					</TR>
					<TR>
					<?php if ($this->countofpoint == '2') : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_gaz(2)" value="2" CHECKED />2
							места установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_gaz(2)" value="2" />2 места
							установки</TD>
							<?php endif; ?>
					</TR>
					<TR>
					<?php if ($this->countofpoint == '3') : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_gaz(3)" value="3" CHECKED />3
							места установки</TD>
							<?php else : ?>
						<TD align=left><input type="radio" name="countpoint"
							id="countpoint" onClick="check_form_gaz(3)" value="3" />3 места
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
						<th align=left id="tg<?=$i ?>">Место установки <?=$i ?>: <?php echo $this->form->getInput('gname'.$i, null, $name[$i]); ?>
						</th>
						<th></th>
					</tr>
					<tr>
						<td align=right id="sng<?=$i ?>">Серийный номер счетчика :</td>
						<td align=left id="psng<?=$i ?>"><?php echo $this->form->getInput('sngaz'.$i, null, $csnp[$i]); ?><FONT
							COLOR="#FF0000">*</FONT></td>
					</tr>
					<tr>
						<td align=right id="dg<?=$i ?>">Дата следующей поверки счетчика :</td>
						<td align=left id="pdg<?=$i ?>"><?php echo $this->form->getInput('dategaz'.$i, null, $cdatep[$i]); ?><FONT
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
							<input type="hidden" name="task" value="sngazs.submit" /> <!--<button class="back_button" id="submit" name="submit" type="submit" value="Передать показания"></button>-->
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
   	echo "<script>check_form_gaz(" . $row->counts . ");</script>";
   	?>
	</td>
</tr>
