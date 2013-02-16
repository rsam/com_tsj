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
		if($this->params['water_show_rows_sn'] == '1') $count_rows++;
		if($this->params['water_show_rows_water'] == '1') $count_rows++;
			
		// Нужно ли отображать серийные номера
		if ($this->params['water_show_rows_sn']) $show_sn = 1;
		else $show_sn = 0;

		// Нужно ли отображать расход
		if ($this->params['water_show_rows_water']) $show_delta = 1;
		else $show_delta = 0;

		// set tables with data of water counters
		echo "<table border='1' width='100%'>";
			
		// Вывод заголовка таблицы
		echo '<tr>';
		echo "<th ROWSPAN='3' align='center'>Дата ввода<br>показаний<br>дд-мм-гггг</th>";
			
		for($i = 1; $i <= $this->dataofsn->counts; $i++)
		{
			echo "<th align='center' COLSPAN='".(($count_rows*2)+2)."'>Место установки " . $i . " :";
			echo ' ' . $this->dataofsn->{'water_name_'.$i} . '</th>';
		}
		echo "<th align='center' COLSPAN='2'>Суммарно</th>";
		echo '</tr>';

		echo '<tr>';
		for($i = 1; $i <= $this->dataofsn->counts; $i++)
		{
			echo "<th align='center' COLSPAN='".($count_rows+1)."'>ХВС</th>
                  <th align='center' COLSPAN='".($count_rows+1)."'>ГВС</th>";

		}
		echo "<th align='center'>ХВС</th>
               <th align='center'>ГВС</th>";
		echo '</tr>';

		// Вывод названий столбцов
		echo '<tr>';
		for($i = 1; $i <= $this->dataofsn->counts; $i++)
		{
			if($show_sn) echo '<th>Серийный<br>номер</th>';
			echo '<th align="center">Показания<br>м3</th>';
			if($show_delta) echo '<th align="center">Расход<br>м3</th>';
			if($show_sn) echo '<th align="center">Серийный<br>номер</th>';
			echo '<th align="center">Показания<br>м3</th>';
			if($show_delta) echo '<th align="center">Расход<br>м3</th>';
		} // for
		echo '<th align="center">Расход<br>м3</th>';
		echo '<th align="center">Расход<br>м3</th>';
		echo '</tr>';

		// Вывод таблицы показаний счетчиков воды
		$prev_row = NULL;
		foreach ( $this->dataofcounter as $row )
		{
			echo '<tr>';
			$date = date('d-m-Y',strtotime($row->date_in));
			$rashod_cold = 0;
			$rashod_hot = 0;
			echo '<td align="center">' . $date . '</td>';

			for($i = 1; $i <= $this->dataofsn->counts; $i++)
			{
				// Вывод серийных номеров
				if($show_sn) echo '<td align="center">' . $row->{'ser_num_cold_p'.$i} . '</td>';

				// Вывод данных
				$rashod =  $row->{'data_cold_c'.$i} - $prev_row->{'data_cold_c'.$i};
				$rashod_cold += $rashod*1; // расход холодная суммарно
				if($rashod < 0){
					echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $row->{'data_cold_c'.$i} . '</b></span></td>';
				}
				else{
					echo '<td align="center">' . $row->{'data_cold_c'.$i} . '</td>'; // показания холодная
				}
					
				// Вывод расхода
				if($show_delta){
					if($rashod < 0){
						echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $rashod . '</b></span></td>';
					}
					else{
						echo '<td align="center">' . $rashod . '</td>'; // расход холодная
					}
				}
					
				// Вывод серийных номеров
				if($show_sn) echo '<td align="center">' . $row->{'ser_num_hot_p'.$i} . '</td>';

				// Вывод данных
				$rashod =  $row->{'data_hot_c'.$i} - $prev_row->{'data_hot_c'.$i};
				$rashod_hot += $rashod*1; // расход горячая суммарно
				if($rashod < 0){
					echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $row->{'data_hot_c'.$i} . '</b></span></td>';
				}
				else{
					echo '<td align="center">' . $row->{'data_hot_c'.$i} . '</td>'; // показания горячая
				}

				// Вывод расхода
				if($show_delta){
					if($rashod < 0){
						echo '<td align="center" style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $rashod . '</b></span></td>';
					}
					else{
						echo '<td align="center">' . $rashod . '</td>'; // расход горячая
					}
				}
			} // for
			echo '<td align="center">' . $rashod_cold . '</td>'; // расход холодная суммарно
			echo '<td align="center">' . $rashod_hot . '</td>'; // расход горячая суммарно
			echo '</tr>';

			$prev_row = $row;
		} // foreach

		echo '</table>';
		?> <?php
	}
	else
	{
		echo '<br><br><h3>База показаний счетчиков воды пуста.</h3>';
	}
	?>
	</td>
</tr>
