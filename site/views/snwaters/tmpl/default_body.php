<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<tr>
	<td><?php
	if(!empty($this->dataofsn))
	{
		// Чтение из таблицы названий точек установки счетчиков
		foreach ( $this->dataofsn as $row )
		{
			$name[1] = $row->water_name_1;
			$name[2] = $row->water_name_2;
			$name[3] = $row->water_name_3;
		}
			
		// set tables with data of water counters
		echo "<table border='1'>
      		<tr>";
			
		echo "<th COLSPAN='4'>Место установки 1:";
		echo ' ' . $name[1] . '</th>';
			
		if(($this->countofpoint == 2) || ($this->countofpoint == 3)){
			echo "<th COLSPAN='4'>Место установки 2:";
			echo ' ' . $name[2] . '</th>';
		}
		if($this->countofpoint == 3){
			echo "<th COLSPAN='4'>Место установки 3:";
			echo ' ' . $name[3] . '</th>';
		}
		echo '</tr>';
			
		echo '<tr>';
		echo "<th COLSPAN='2'>ХВС</th>
                      <th COLSPAN='2'>ГВС</th>";
		if(($this->countofpoint == 2) || ($this->countofpoint == 3)){
			echo "<th COLSPAN='2'>ХВС</th>
                      <th COLSPAN='2'>ГВС</th>";
		}
		if($this->countofpoint == 3){
			echo "<th COLSPAN='2'>ХВС</th>
                      <th COLSPAN='2'>ГВС</th>";
		}
		echo '</tr>';
			
		echo '<tr>';
		echo '<th>Серийный<br>номер</th>';
		echo '<th>Дата ввода</th>';
			
		echo '<th>Серийный<br>номер</th>';
		echo '<th>Дата ввода</th>';
			
		if(($this->countofpoint == 2) || ($this->countofpoint == 3)){
			echo '<th>Серийный<br>номер</th>';
			echo '<th>Дата ввода</th>';

			echo '<th>Серийный<br>номер</th>';
			echo '<th>Дата ввода</th>';
		}
		if($this->countofpoint == 3){
			echo '<th>Серийный<br>номер</th>';
			echo '<th>Дата ввода</th>';

			echo '<th>Серийный<br>номер</th>';
			echo '<th>Дата ввода</th>';
		}
		echo '</tr>';
			
		$prev_row = NULL;
		foreach ( $this->dataofsn as $row )
		{
			echo '<tr>';
			echo '<td>' . $row->ser_num_cold_p1 . '</td>';
			echo '<td>' . $row->date_in_cold_pp1 . '</td>';
			echo '<td>' . $row->ser_num_hot_p1 . '</td>';
			echo '<td>' . $row->date_in_hot_pp1 . '</td>';

			if(($this->countofpoint == 2) || ($this->countofpoint == 3)){
				echo '<td>' . $row->ser_num_cold_p2 . '</td>';
				echo '<td>' . $row->date_in_cold_pp2 . '</td>';
				echo '<td>' . $row->ser_num_hot_p2 . '</td>';
				echo '<td>' . $row->date_in_hot_pp2 . '</td>';
			}
			if($this->countofpoint == 3){
				echo '<td>' . $row->ser_num_cold_p3 . '</td>';
				echo '<td>' . $row->date_in_cold_pp3 . '</td>';
				echo '<td>' . $row->ser_num_hot_p3 . '</td>';
				echo '<td>' . $row->date_in_hot_pp3 . '</td>';
			}
			echo '</tr>';

			$prev_row = $row;
		}
		echo '</table>';
		?> <?php
	}
	else
	{
		echo '<br><br><h3>База серийных номеров счетчиков пуста.</h3>';
	}
	?>
	</td>
</tr>
