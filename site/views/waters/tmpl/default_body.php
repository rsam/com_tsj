<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');  
?>

<tr>
	<td>
   <?php
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
    	echo "<table border='1'>";
    	
    	// Вывод заголовка таблицы
      echo '<tr>';
			echo "<th ROWSPAN='3'>Дата ввода<br>показаний<br>дд-мм-гггг</th>";
			
			for($i = 1; $i <= $this->dataofsn->counts; $i++)
			{
			   echo "<th COLSPAN='".(($count_rows*2)+2)."'>Место установки " . $i . " :";
			   echo ' ' . $this->dataofsn->{'water_name_'.$i} . '</th>';
			}
		echo '</tr>';

		echo '<tr>';
		   for($i = 1; $i <= $this->dataofsn->counts; $i++)
         {
			   echo "<th COLSPAN='".($count_rows+1)."'>ХВС</th>
                  <th COLSPAN='".($count_rows+1)."'>ГВС</th>";
			   
         }
		echo '</tr>';  
      
		// Вывод названий столбцов
		echo '<tr>';
         for($i = 1; $i <= $this->dataofsn->counts; $i++)
         {
            if($show_sn) echo '<th>Серийный<br>номер</th>';
            echo '<th>Показания<br>м3</th>';
            if($show_delta) echo '<th>Расход<br>м3</th>';
            if($show_sn) echo '<th>Серийный<br>номер</th>';
			   echo '<th>Показания<br>м3</th>';
            if($show_delta) echo '<th>Расход<br>м3</th>';
         } // for
		echo '</tr>';  

      // Вывод таблицы показаний счетчиков воды
      $prev_row = NULL;
      foreach ( $this->dataofcounter as $row )
      {
         echo '<tr>';
             $date = date('d-m-Y',strtotime($row->date_in));
             
			echo '<td>' . $date . '</td>';
			
			for($i = 1; $i <= $this->dataofsn->counts; $i++)
         {
            // Вывод серийных номеров
            if($show_sn) echo '<td>' . $row->{'ser_num_cold_p'.$i} . '</td>';
            
            // Вывод данных
            $rashod =  $row->{'data_cold_c'.$i} - $prev_row->{'data_cold_c'.$i};
            if($rashod < 0){
               echo '<td style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $row->{'data_cold_c'.$i} . '</b></span></td>';
            }
            else{
               echo '<td>' . $row->{'data_cold_c'.$i} . '</td>';
            }
             
            // Вывод расхода
            if($show_delta){
               if($rashod < 0){
                  echo '<td style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $rashod . '</b></span></td>';
               }
               else{
                  echo '<td>' . $rashod . '</td>';
               }
            }
             
            // Вывод серийных номеров
            if($show_sn) echo '<td>' . $row->{'ser_num_hot_p'.$i} . '</td>';
             
            // Вывод данных
            $rashod =  $row->{'data_hot_c'.$i} - $prev_row->{'data_hot_c'.$i};
            if($rashod < 0){
               echo '<td style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $row->{'data_hot_c'.$i} . '</b></span></td>';
            }
            else{
               echo '<td>' . $row->{'data_hot_c'.$i} . '</td>';
            }
            
            // Вывод расхода
            if($show_delta){
               if($rashod < 0){
                  echo '<td style="background-color: #FF0000;"><span style="color: #ffffff;"><b>' . $rashod . '</b></span></td>';
               }
               else{
                  echo '<td>' . $rashod . '</td>';
               }
            }
         } // for
			echo '</tr>';
            
         $prev_row = $row;
      } // foreach
      
		echo '</table>';	
   ?>
   
   <?php 
   }
   else
   {
      echo '<br><br><h3>База показаний счетчиков воды пуста.</h3>';
   }
   ?>
	</td>
</tr>