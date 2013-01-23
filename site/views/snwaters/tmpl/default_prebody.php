<script Language="JavaScript">
<!--
function check_form(value)
{
   if(value == 2)
   {
	   document.getElementById('th2').style.display="";
	   document.getElementById('snh2').style.display="";
	   document.getElementById('dh2').style.display="";
	   document.getElementById('snc2').style.display="";
	   document.getElementById('dc2').style.display="";
	   document.getElementById('psnh2').style.display="";
	   document.getElementById('pdh2').style.display="";
	   document.getElementById('psnc2').style.display="";
	   document.getElementById('pdc2').style.display="";
	   document.snwaters.snwaters_wname2.disabled = false;
	   document.snwaters.snwaters_wname2.style.display="";
	   document.snwaters.snwaters_sncwater2.disabled = false;
	   document.snwaters.snwaters_sncwater2.style.display="";
      document.snwaters.snwaters_snhwater2.disabled = false;
      document.snwaters.snwaters_snhwater2.style.display="";
      document.snwaters.snwaters_datecwater2.disabled = false;
      document.snwaters.snwaters_datecwater2.style.display="";
      document.snwaters.snwaters_datehwater2.disabled = false;
      document.snwaters.snwaters_datehwater2.style.display="";

      document.getElementById('th3').style.display="none";
      document.getElementById('snh3').style.display="none";
      document.getElementById('dh3').style.display="none";
      document.getElementById('snc3').style.display="none";
      document.getElementById('dc3').style.display="none";
      document.getElementById('psnh3').style.display="none";
      document.getElementById('pdh3').style.display="none";
      document.getElementById('psnc3').style.display="none";
      document.getElementById('pdc3').style.display="none";
      document.snwaters.snwaters_sncwater3.disabled = true;
      document.snwaters.snwaters_sncwater3.style.display="none";
      document.snwaters.snwaters_snhwater3.disabled = true;
      document.snwaters.snwaters_snhwater3.style.display="none";
      document.snwaters.snwaters_datecwater3.disabled = true;
      document.snwaters.snwaters_datecwater3.style.display="none";
      document.snwaters.snwaters_datehwater3.disabled = true;
      document.snwaters.snwaters_datehwater3.style.display="none";
      document.snwaters.snwaters_wname3.disabled = true;
      document.snwaters.snwaters_wname3.style.display="none";
   }
   else if(value == 3)
   {
	   document.getElementById('th2').style.display="";
	   document.getElementById('snh2').style.display="";
	   document.getElementById('dh2').style.display="";
	   document.getElementById('snc2').style.display="";
	   document.getElementById('dc2').style.display="";
	   document.getElementById('psnh2').style.display="";
	   document.getElementById('pdh2').style.display="";
	   document.getElementById('psnc2').style.display="";
	   document.getElementById('pdc2').style.display="";
	   document.snwaters.snwaters_sncwater2.disabled = false;
	   document.snwaters.snwaters_sncwater2.style.display="";
    	document.snwaters.snwaters_snhwater2.disabled = false;
    	document.snwaters.snwaters_snhwater2.style.display="";
      document.snwaters.snwaters_datecwater2.disabled = false;
      document.snwaters.snwaters_datecwater2.style.display="";
      document.snwaters.snwaters_datehwater2.disabled = false;
      document.snwaters.snwaters_datehwater2.style.display="";
    	document.snwaters.snwaters_datehwater2.disabled = false;
    	document.snwaters.snwaters_datehwater2.style.display="";
      document.snwaters.snwaters_wname2.disabled = false;
      document.snwaters.snwaters_wname2.style.display="";
      
      document.getElementById('th3').style.display="";
      document.getElementById('snh3').style.display="";
      document.getElementById('dh3').style.display="";
      document.getElementById('snc3').style.display="";
      document.getElementById('dc3').style.display="";
      document.getElementById('psnh3').style.display="";
      document.getElementById('pdh3').style.display="";
      document.getElementById('psnc3').style.display="";
      document.getElementById('pdc3').style.display="";
      document.snwaters.snwaters_sncwater3.disabled = false;
      document.snwaters.snwaters_sncwater3.style.display="";
    	document.snwaters.snwaters_snhwater3.disabled = false;
    	document.snwaters.snwaters_snhwater3.style.display="";
      document.snwaters.snwaters_datecwater3.disabled = false;
      document.snwaters.snwaters_datecwater3.style.display="";
      document.snwaters.snwaters_datehwater3.disabled = false;
      document.snwaters.snwaters_datehwater3.style.display="";
      document.snwaters.snwaters_wname3.disabled = false;
      document.snwaters.snwaters_wname3.style.display="";
   }
   else
   {
	   document.getElementById('th2').style.display="none";
	   document.getElementById('snh2').style.display="none";
	   document.getElementById('dh2').style.display="none";
	   document.getElementById('snc2').style.display="none";
	   document.getElementById('dc2').style.display="none";
	   document.getElementById('psnh2').style.display="none";
	   document.getElementById('pdh2').style.display="none";
	   document.getElementById('psnc2').style.display="none";
	   document.getElementById('pdc2').style.display="none";
	   document.snwaters.snwaters_sncwater2.disabled = true;
	   document.snwaters.snwaters_sncwater2.style.display="none";
	   document.snwaters.snwaters_snhwater2.disabled = true;
	   document.snwaters.snwaters_snhwater2.style.display="none";
	   document.snwaters.snwaters_datecwater2.disabled = true;
	   document.snwaters.snwaters_datecwater2.style.display="none";
	   document.snwaters.snwaters_datehwater2.disabled = true;
	   document.snwaters.snwaters_datehwater2.style.display="none";
      document.snwaters.snwaters_wname2.disabled = true;
      document.snwaters.snwaters_wname2.style.display="none";

      document.getElementById('th3').style.display="none";
      document.getElementById('snh3').style.display="none";
      document.getElementById('dh3').style.display="none";
      document.getElementById('snc3').style.display="none";
      document.getElementById('dc3').style.display="none";
      document.getElementById('psnh3').style.display="none";
      document.getElementById('pdh3').style.display="none";
      document.getElementById('psnc3').style.display="none";
      document.getElementById('pdc3').style.display="none";
      document.snwaters.snwaters_sncwater3.disabled = true;
      document.snwaters.snwaters_sncwater3.style.display="none";
      document.snwaters.snwaters_snhwater3.disabled = true;
      document.snwaters.snwaters_snhwater3.style.display="none";
      document.snwaters.snwaters_datecwater3.disabled = true;
      document.snwaters.snwaters_datecwater3.style.display="none";
      document.snwaters.snwaters_datehwater3.disabled = true;
      document.snwaters.snwaters_datehwater3.style.display="none";
      document.snwaters.snwaters_wname3.disabled = true;
      document.snwaters.snwaters_wname3.style.display="none";
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
		         $csnp[$i] = $row->{'ser_num_cold_p'.$i};
		         $hsnp[$i] = $row->{'ser_num_hot_p'.$i};
		          
		         $cdatep[$i] = $row->{'date_in_cold_pp'.$i};
		         $hdatep[$i] = $row->{'date_in_hot_pp'.$i};
		          
		         $name[$i] = $row->{'water_name_'.$i};
		      }
		   }
		}
	    
	   if($row->counts == 0) $this->countofpoint = 1;
      else $this->countofpoint = $row->counts;

	   $date = date("Y-m-d");
	   //$date_month = date("Y-m");
	   $day = date("d");
	   ?>

	<form class="form-validate" name="snwaters" id="snwaters"
		action="<?php echo JRoute::_('index.php'); ?>" 
		method="post" <?php if(!empty($this->dataofsn)) echo 'onSubmit="return verify()"'; ?>
	>
	<fieldset><!--<legend>Ввод показаний индивидуальных счетчиков воды</legend>-->

	<TABLE BORDER=0 COLS=2 BGCOLOR="#FFF4FF">
		<TR>
			<TH align=left>Количество мест установки :</TH>
		</TR>
		
		
		<TR>
		<?php if (($this->countofpoint == '1') || ($this->countofpoint == NULL)) : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(1)" value="1" CHECKED />1 место установки (два
			счетчика)</TD>
			<?php else : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(1)" value="1" />1 место установки (два счетчика)</TD>
				<?php endif; ?>
		</TR>
		<TR>
		<?php if ($this->countofpoint == '2') : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(2)" value="2" CHECKED />2 места установки
			(четыре счетчика)</TD>
			<?php else : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(2)" value="2" />2 места установки (четыре
			счетчика)</TD>
			<?php endif; ?>
		</TR>
		<TR>
		<?php if ($this->countofpoint == '3') : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(3)" value="3" CHECKED />3 места установки (шесть
			счетчиков)</TD>
			<?php else : ?>
			<TD align=left><input type="radio" name="countpoint" id="countpoint"
				onClick="check_form(3)" value="3" />3 места установки (шесть
			счетчиков)</TD>
			<?php endif; ?>
		</TR>
		
	</TABLE>
	<BR>
	<BR>

	<table BORDER=0 COLS=2 BGCOLOR="#FFF4FF">
	<?php
	$counts = 3;
	for($i = 1; $i <= $counts; $i++)
	{
	?>

		<tr>
			<th align=left id="th<?=$i ?>">Место установки <?=$i ?>: <?php echo $this->form->getInput('wname'.$i, null, $name[$i]); ?></th>
			<th></th>
		</tr>
		<tr>
			<td align=right id="snc<?=$i ?>">Серийный номер счетчика ХВС (холодной воды) :</td>
			<td align=left id="psnc<?=$i ?>"><?php echo $this->form->getInput('sncwater'.$i, null, $csnp[$i]); ?><FONT
				COLOR="#FF0000">*</FONT></td>
		</tr>
		<tr>
			<td align=right id="dc<?=$i ?>">Дата следующей поверки счетчика ХВС (холодной воды) :</td>
			<td align=left id="pdc<?=$i ?>"><?php echo $this->form->getInput('datecwater'.$i, null, $cdatep[$i]); ?><FONT
				COLOR="#FF0000">*</FONT></td>
		</tr>
		<tr>
			<td align=right id="snh<?=$i ?>">Серийный номер счетчика ГВС (горячей воды) :</td>
			<td align=left id="psnh<?=$i ?>"><?php echo $this->form->getInput('snhwater'.$i, null, $hsnp[$i]); ?><FONT
				COLOR="#FF0000">*</FONT></td>
		</tr>
		<tr>
			<td align=right id="dh<?=$i ?>">Дата следующей поверки счетчика ГВС (горячей воды) :</td>
			<td align=left id="pdh<?=$i ?>"><?php echo $this->form->getInput('datehwater'.$i, null, $hdatep[$i]); ?><FONT
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
			<input type="hidden" name="task" value="snwaters.submit" /> <!--<button class="back_button" id="submit" name="submit" type="submit" value="Передать показания"></button>-->
			<input id="submit" name="submit" type="submit"
				value="Передать данные" /> <?php echo JHtml::_('form.token'); ?></td>
			<td align=right></td>
		</tr>
		<tr>
		</tr>
	</table>

	</fieldset>

	  <div class="clr"></div>
	</form>
	<br>
   	<?php
   	echo "<script>check_form(" . $row->counts . ");</script>";
   	?>
   </td>
</tr>
