<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class MyHelper
{

	public $startday;
	public $stopday;

	/**
	 * Returns a list of post items
	 */
	public function Check($test, $date, $day)
	{
		$form = 1;

		$startday = $this->params['water_startDay'];
		$stopday = $this->params['water_stopDay'];

		$date_elements  = explode("-",$date);
		$datem = $date_elements[0]. "-". $date_elements[1];

		// Условие доступности формы для ввода показаний счетчиков воды
		// $form == 0 - форма не доступна
		if($startday < $stopday){
			if( ($day < $startday) || ($day > $stopday) ) $form = 0;
		}
		else if($startday > $stopday){
			if( ($day > $stopday) && ($day < $startday) ) $form = 0;
		}

		//echo 'day='.$day.'start='.$startday.'stop='.$stopday.'form='.$form;
		//echo $date;

		// Вывод предупреждения о повторном вводе
		if($form == 1)
		{
			if($this->dataofcounter != NULL)
			{
				// Возможные варианты дат начала, окончания и текущей даты или даты из таблицы показаний
				// 5..10 7
				// 10..5 1
				// 10..5 20

				foreach ( $this->dataofcounter as $row )
				{
					//echo 'date_in='.$row->date_in;
					$newdata = 0;

					if($stopday == $startday){
						//echo ' 4 ';
						if($stopday != 1) $stopday = $stopday - 1;
						else $stopday = 31;
						//$strdate1 = new DateTime($datem . '-' . $startday);
						//$stpdate1 = new DateTime($datem . '-' . $stopday);
						//$strdate1->modify("-1 day");
						//if( ($row->date_in >= $strdate1->format('Y-m-d')) && ($row->date_in <= $stpdate1->format('Y-m-d')) ) $newdata = 1;
					}
						
					// 5..10 7
					if($stopday > $startday){
						//echo ' 1 ';
						$strdate1 = new DateTime($datem . '-' . $startday);
						$stpdate1 = new DateTime($datem . '-' . $stopday);
						if( ($row->date_in >= $strdate1->format('Y-m-d')) && ($row->date_in <= $stpdate1->format('Y-m-d')) ) $newdata = 1;
					}
						
					/*if($stopday == $startday){
						echo ' 4 ';
						$strdate1 = new DateTime($datem . '-' . $startday);
						$strdate1->modify("-1 months");
						$stpdate1 = new DateTime($datem . '-' . $stopday);
						if( ($row->date_in >= $strdate1->format('Y-m-d')) && ($row->date_in <= $stpdate1->format('Y-m-d')) ) $newdata = 1;
						}*/
						
					if($startday > $stopday){
						// 10..5 1
						if(($date_elements[2] <= $startday) && ($date_elements[2] <= $stopday)){
							//echo ' 2 ';
							$strdate1 = new DateTime($datem . '-' . $startday);
							$strdate1->modify("-1 months");
							$stpdate1 = new DateTime($datem . '-' . $stopday);
								
							if(($row->date_in < $stpdate1->format('Y-m-d')) || ($row->date_in >= $strdate1->format('Y-m-d'))) $newdata = 1;
						}

						// 10..5 20
						if(($date_elements[2] >= $startday) && ($date_elements[2] >= $stopday)){
							//echo ' 3 ';
							$stpdate1 = new DateTime($datem . '-' . $stopday);
							$stpdate1->modify("+1 months");
							$strdate1 = new DateTime($datem . '-' . $startday);
								
							if(($row->date_in >= $strdate1->format('Y-m-d')) && ($row->date_in <= $stpdate1->format('Y-m-d'))) $newdata = 1;
						}
					}

					//echo ' str='.$strdate1->format('Y-m-d');
					//echo ' stp='.$stpdate1->format('Y-m-d');
					//if($row->date_in == $date)
					if($newdata == 1)
					{
						echo '<h3>Вы уже вводили данные в этом периоде.</h3>';
						echo '<h3>При вводе данных повторно, предыдущие данные будут заменены вновь введенными.</h3>';
						break;
					}
				}
			}
		}
		else
		{
			echo '<br><h3>Извините. Сегодня ввод показаний счетчиков невозможен.</h3>';
		}

		return $form;
	} //end Check

}
?>