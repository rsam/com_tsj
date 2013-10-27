<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем helper.php
//require_once(dirname(JPATH_COMPONENT).'/com_tsj/helpers/helper.php');

// Include dependancy of the main model form
jimport('joomla.application.component.modelform');
// import Joomla modelitem library
//jimport('joomla.application.component.modelitem');
// Include dependancy of the dispatcher
//jimport('joomla.event.dispatcher');

/**
 * TSJ Model Gaz
 */
class TSJModelGazs extends JModelForm
{
	/**
	 * @var string msg
	 */
	protected $msg;

	/**
	 * @var integer count of points with gaz counters
	 */
	protected $countofpoint;

	/**
	 * @var array string name of points with gaz counters
	 */
	protected $name;

	/**
	 * @var double data gaz counters
	 */
	protected $data = array("","");

	/**
	 * @var integer id office
	 */
	protected $office_counter_id;

	/**
	 * @var string username eq. account
	 */
	public $username;

	/**
	 * @var pointer to global object database
	 */
	public $db;

	/**
	 * Constructor for set class variables
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Чтение username из таблицы User
		$user = &JFactory::getUser();

		$this->username = $user->get('id');
		if($this->username == null) $this->username = 0;

		// Возвращаем ссылку на глобальный объект базы данных
		$this->db = $this->getDBO();
		if (!$this->db->connected()) {
			echo "Нет соединения с сервером баз данных. Повторите запрос позже";
			jexit();
		}

		### for test only
		//$this->username = 6334;

	}

	/**
	 * Returns params of gaz counters.
	 *
	 * @return  JTable   A database object
	 * @since   2.5
	 */
	public function getParams()
	{
		$params = array();

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_prefix_text';" );
		$row =& $this->db->loadResult();

		// Проверка на ошибки
		if (!$result = $this->db->query()) {
			//echo $this->db->stderr();
			return false;
		}
		$params['gaz_prefix_text'] = $row;

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_show_rows_sn';" );
		$row =& $this->db->loadResult();
		$params['gaz_show_rows_sn'] = $row;

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_show_rows_gaz';" );
		$row =& $this->db->loadResult();
		$params['gaz_show_rows_gaz'] = $row;

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_linksn';" );
		$row =& $this->db->loadResult();
		$params['gaz_linksn'] = $row;

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_startDay';" );
		$row =& $this->db->loadResult();
		$params['gaz_startDay'] = $row;

		$this->db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_stopDay';" );
		$row =& $this->db->loadResult();
		$params['gaz_stopDay'] = $row;

		return $params;
	}

	/**
	 * Returns a data of gaz counters.
	 *
	 * @return  JTable   A database object
	 * @since   2.5
	 */
	public function getDataOfCounters()
	{
		if (!isset($this->msg))
		{
			// Получаем версию Joomla
			/*$version = new JVersion;
			 $joomla = $version->getShortVersion();
			 if(substr($joomla,0,3) == '2.5'){

			 }*/

			// Подготовка запроса на получение данных счетчиков воды
			$sql = " SELECT  t2.user_id,
                          t1.counts,
                          t1.gaz_name_1, t1.date_in_p1, t1.ser_num_p1, t3.data_c1,
                          t1.gaz_name_2, t1.date_in_p2, t1.ser_num_p2, t3.data_c2,
                          t1.gaz_name_3, t1.date_in_p3, t1.ser_num_p3, t3.data_c3,
                          t3.date_in
                  FROM #__tsj_gaz_office t1
                  INNER JOIN #__tsj_account t2 ON t1.account_id = t2.account_id AND t2.user_id ='" . $this->username . "'" .
                " INNER JOIN #__tsj_gaz_data t3 ON t1.office_counter_id = t3.office_counter_id
                  GROUP BY t3.date_in;";

			// Выполнение запроса в базу данных и получения списка строк соответствующих запросу row
			$this->db->setQuery( $sql );
			$row =& $this->db->loadObjectList();

			// Проверка на ошибки
			if (!$result = $this->db->query()) {
				//echo $this->db->stderr();
				return false;
			}

			if (empty($row))
			{
				return NULL;
			}

			$this->msg = true;
		}

		return $row;
	}

	/**
	 * Returns serial number of gaz counters and name of points.
	 *
	 * @return  JTable   A database object
	 * @since   2.5
	 */
	public function getDataOfSN()
	{
		if (!isset($this->msg))
		{
			// Подготовка запроса на получение показаний счетчиков
			$sql = " SELECT t1.office_counter_id, t2.user_id,
                        t1.counts,
                        t1.gaz_name_1, DATE_FORMAT( t1.date_in_p1, '%d-%m-%Y' ) AS date_in_pp1 , t1.ser_num_p1,
                        t1.gaz_name_2, DATE_FORMAT( t1.date_in_p2, '%d-%m-%Y' ) AS date_in_pp2, t1.ser_num_p2,
                        t1.gaz_name_3, DATE_FORMAT( t1.date_in_p3, '%d-%m-%Y' ) AS date_in_pp3, t1.ser_num_p3
                  FROM #__tsj_gaz_office t1
                  INNER JOIN #__tsj_account t2 ON t1.account_id = t2.account_id AND t2.user_id ='" . $this->username . "'" .
                " GROUP BY t1.office_counter_id DESC limit 1;";

			// Выполнение запроса в базу данных и получения списка строк соответствующих запросу row
			$this->db->setQuery( $sql );
			$row =& $this->db->loadObject();
			$this->office_counter_id = $row->office_counter_id;
			//echo $office_counter_id;

			// Проверка на ошибки
			if (!$result = $this->db->query()) {
				//echo $this->db->stderr();
				return false;
			}

			if (empty($row))
			{
				return NULL;
			}
		}

		return $row;
	}

	/**
	 * Get the data for a new qualification
	 */
	public function getForm($data = array(), $loadData = true)
	{
		//$app = JFactory::getApplication('site');

		// Вернуть форму
		$form = $this->loadForm('com_tsj.gazs', 'gazs', array('control' => 'gazs', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;

	}

	/**
	 * Set data of gaz counters.
	 *
	 * @return  result
	 * @since   2.5
	 */
	public function setDataOfCounters($data)
	{
		// Получить текущую дату для последующего сохранения в базу
		$date = date("Y-m-d");
		// Получить месяц и год для последующей проверки на повтор ввода данных за месяц
		//$date_month = date("Y-m");
		//$date_day = date("d");

		// установить переменные из полей формы
		$gaz1 = $data['gaz1'];
		$gaz2 = $data['gaz2'];
		$gaz3 = $data['gaz3'];

		// подготовка запроса в базу данных для определения office_counter_id
		$sql = " SELECT   t1.office_counter_id, t2.user_id,
                        t1.counts,
                        t1.gaz_name_1, DATE_FORMAT( t1.date_in_p1, '%d-%m-%Y' ) AS date_in_pp1 , t1.ser_num_p1,
                        t1.gaz_name_2, DATE_FORMAT( t1.date_in_p2, '%d-%m-%Y' ) AS date_in_pp2, t1.ser_num_p2,
                        t1.gaz_name_3, DATE_FORMAT( t1.date_in_p3, '%d-%m-%Y' ) AS date_in_pp3, t1.ser_num_p3
               FROM #__tsj_gaz_office t1
               INNER JOIN #__tsj_account t2 ON t1.account_id = t2.account_id AND t2.user_id ='" . $this->username . "'" .
             " GROUP BY t1.office_counter_id DESC limit 1;";


		// Выполнение запроса в базу данных и получения списка строк соответствующих запросу row
		$this->db->setQuery( $sql );
		$rows =& $this->db->loadObject();

		// Проверка на ошибки
		if (!$result = $this->db->query()) {
			echo $this->db->stderr();
			return false;
		}

		if (empty($rows))
		{
			return NULL;
		}

		$this->office_counter_id = $rows->office_counter_id;

		// подготовка запроса в базу данных для последующей проверки на повторный ввод данных в месяце
		$sql = " SELECT   t2.user_id, t3.gaz_id, t3.office_counter_id,
                        t1.counts,
                        t1.gaz_name_1, t1.date_in_p1, t1.ser_num_p1, t3.data_c1,
                        t1.gaz_name_2, t1.date_in_p2, t1.ser_num_p2, t3.data_c2,
                        t1.gaz_name_3, t1.date_in_p3, t1.ser_num_p3, t3.data_c3,
                        t3.date_in
               FROM #__tsj_gaz_office t1
               INNER JOIN #__tsj_account t2 ON t1.account_id = t2.account_id AND t2.user_id ='" . $this->username . "'" .
             " INNER JOIN #__tsj_gaz_data t3 ON t1.office_counter_id = t3.office_counter_id
               GROUP BY t3.date_in;";

		// Выполнение запроса в базу данных и получения списка строк соответствующих запросу row
		$this->db->setQuery( $sql );
		$rows =& $this->db->loadObjectList();

		// Проверка на ошибки
		if (!$result = $this->db->query()) {
			echo $this->db->stderr();
			return false;
		}

		/*if (empty($row))
		 {
		 // База пуста
		 }*/

		// Количество найденных записей удовлетворяющих запросу для офиса
		$nrow = count($rows);
		$tid = 0;
		if($nrow > 0)
		{
			$params = TSJModelGazs::getParams();
			$startday = $params['gaz_startDay'];
			$stopday = $params['gaz_stopDay'];

			$date_elements  = explode("-",$date);
			$datem = $date_elements[0]. "-". $date_elements[1];

			// Если записи есть, то проверка по записям на повтор ввода данных в месяце
			foreach($rows as $row)
			{
				$newdata = 0;
				//echo 'date_in='.$row->date_in;
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
				if($newdata == 1)
				{
					// В текущем месяце данные уже вводили
					$tid = $row->gaz_id;
					//echo $tid;
					break;
				}
			}

		}
		//echo qqq.$office_counter_id;

		if($tid != 0)
		{
			//echo 'Обновление записи в базе';
			$sql = " UPDATE   #__tsj_gaz_data
                  SET   date_in='$date', data_hot_c1='$gaz1',
                        data_c2='$gaz2',
                        data_c3='$gaz3',
                  WHERE gaz_id='$tid'";
			$this->db->setQuery( $sql );
		}
		else
		{
			//echo 'Сохранение записи в базе';
			$sql = " INSERT INTO #__tsj_gaz_data
                           (office_counter_id,data_c1,data_c2,data_c3,date_in) 
                  VALUES   ('$this->office_counter_id','$gaz1','$gaz2','$gaz3','$date')";
			$this->db->setQuery( $sql );
		}

		// Проверка на ошибки
		if (!$this->db->query())
		{
			JError::raiseError(500, $this->db->getErrorMsg());
			return false;
		}
		else
		{
			return true;
		}
	}
}