<?php
/**
 * @author  Idiot & RSA
 **/

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
/*****************************************
 таблица вывода показаний счётчиков

 *****************************************/
 
?>

<tr>
	<td style="padding: 10px;"><?php
	if(!empty($this->dataofcounter))
	{
		// Чтение параметров отобажения таблицы
		$count_rows = 0;
		if($this->params['gaz_show_rows_sn'] == '1') $count_rows++;
		if($this->params['gaz_show_rows_gaz'] == '1') $count_rows++;
			
		// Нужно ли отображать серийные номера
		if ($this->params['gaz_show_rows_sn']) $show_sn = 1;
		else $show_sn = 0;

		// Нужно ли отображать gaz
		if ($this->params['gaz_show_rows_gaz']) $show_delta = 1;
		else $show_delta = 0;

		// set tables with data of water counters
		echo "<table border='1' width='100%'>";
			
		// Вывод заголовка таблицы
		echo '<tr>';
		echo "<th ROWSPAN='2' align='center'>Дата ввода<br>показаний<br>дд-мм-гггг</th>";
			
		for($i = 1; $i <= $this->dataofsn->counts; $i++)
		{
			echo "<th align='center' COLSPAN='".($count_rows+1)."'>Место установки " . $i . " :";
			echo ' ' . $this->dataofsn->{'gaz_name_'.$i} . '</th>';
		}
		echo "<th align='center' COLSPAN='1'>Суммарно</th>";
		echo '</tr>';

		// Вывод названий столбцов
		echo '<tr>';
		for($i = 1; $i <= $this->dataofsn->counts; $i++)
		{
			if($show_sn) echo '<th>Серийный<br>номер</th>';
			echo '<th align="center">Показания<br>м3</th>';
			if($show_delta) echo '<th align="center">Расход<br>м3</th>';
		} // for
		echo '<th align="center">Расход<br>м3</th>';
		echo '</tr>';

		// Вывод таблицы показаний счетчиков воды
		$prev_row = NULL;
		foreach ( $this->dataofcounter as $row )
		{
			echo '<tr>';
			$date = date('d-m-Y',strtotime($row->date_in));
			$rashod_hot = 0;
			echo '<td align="center">' . $date . '</td>';

			for($i = 1; $i <= $this->dataofsn->counts; $i++)
			{
				// Вывод серийных номеров
				if($show_sn) echo '<td align="center">' . $row->{'ser_num_p'.$i} . '</td>';

				// Вывод данных
				$rashod =  $row->{'data_c'.$i} - $prev_row->{'data_c'.$i};
				$rashod_sum += $rashod*1; // gaz суммарно
				if($rashod < 0){
					echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $row->{'data_c'.$i} . '</b></span></td>';
				}
				else{
					echo '<td align="center">' . $row->{'data_c'.$i} . '</td>'; // показания
				}
					
				// Вывод gazа
				if($show_delta){
					if($rashod < 0){
						echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $rashod . '</b></span></td>';
					}
					else{
						echo '<td align="center">' . $rashod . '</td>'; // gaz
					}
				}
					
			} // for
			echo '<td align="center">' . $rashod_sum . '</td>'; // gaz холодная суммарно
			echo '</tr>';

			$prev_row = $row;
		} // foreach

		echo '</table>';
		?> <?php
	}
	else
	{
		echo '<br><br><h3>База показаний счетчиков газа пуста.</h3>';
	}
	?>
	</td>
</tr>
