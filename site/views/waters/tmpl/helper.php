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
		$form = 0;

		$startday = $this->params['water_startDay'];
      $stopday = $this->params['water_stopDay'];  

      if($startday <= $stopday){
			if( ($day < $startday) || ($day > $stopday) ) $form = 1;
      }
      else {
      	if( ($day < $stopday) || ($day > $startday) ) $form = 1;
      }

      //echo 'day='.$day.'start='.$startday.'stop='.$stopday.'form='.$form;

		if($form == 0)
		{
				if($this->dataofcounter != NULL)
				{
	            foreach ( $this->dataofcounter as $row )
	            {
	                //echo 'date_in='.$row->date_in;
	                if($row->date_in == $date)
	                {
	                    echo '<br><h4>Вы уже вводили сегодня данные.</h4>';
	                    //echo '<h4>Пожалуйста повторите ввод в другой день.</h4>';
	                    //$form = 1;
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