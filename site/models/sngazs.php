<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Include dependancy of the main model form
jimport('joomla.application.component.modelform');
// import Joomla modelitem library
//jimport('joomla.application.component.modelitem');
// Include dependancy of the dispatcher
//jimport('joomla.event.dispatcher');

/**
 * TSJ Serial Number Model, Water
 */
class TSJModelSNGazs extends JModelForm
{
	/**
	 * @var string msg
	 */
	protected $msg;

	/**
	 * @var int count of points
	 */
	public $countofpoint;

	/**
	 * @var string name of points
	 */
	protected $name;

	/**
	 * @var form data
	 */
	protected $data = array("","");

	/**
	 * Constructor for set class variables
	 */
	 
	/**
	 * @var string username eq. account
	 */
	public $username;

	/**
	 * @var pointer to global object database
	 */
	public $db;
	 
	public function __construct($config)
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
	 * Returns serial number of gaz counters.
	 *
	 * @return  JTable   A database object
	 * @since   2.5
	 */
	public function getDataOfSN()
	{
		if (!isset($this->msg))
		{
			// DATE_FORMAT используем для перевода даты из Y-m-d в d-m-Y
			$sql = "SELECT t1.office_counter_id, t2.user_id,
                        t1.counts,
                        t1.gaz_name_1, DATE_FORMAT( t1.date_in_p1, '%d-%m-%Y' ) AS date_in_pp1 , t1.ser_num_p1,
                        t1.gaz_name_2, DATE_FORMAT( t1.date_in_p2, '%d-%m-%Y' ) AS date_in_pp2, t1.ser_num_p2,
                        t1.gaz_name_3, DATE_FORMAT( t1.date_in_p3, '%d-%m-%Y' ) AS date_in_pp3, t1.ser_num_p3
                 FROM #__tsj_gaz_office t1
                 INNER JOIN #__tsj_account t2 ON t1.account_id = t2.account_id AND t2.user_id ='" . $this->username . "'" .
               " GROUP BY t1.office_counter_id;";

			$this->db->setQuery( $sql );
			$row =& $this->db->loadObjectList();

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

		// Get the form.
		$form = $this->loadForm('com_tsj.sngazs', 'sngazs', array('control' => 'sngazs', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;

	}

	/**
	 * Set data of SN gaz counters.
	 *
	 * @return  result
	 * @since   2.5
	 */
	public function setDataOfSN($data, $data1)
	{
		$date = date("Y-m-d");
		$date_month = date("Y-m");
		$day = date("d");

		// set the variables from the passed data
		$countpoint = $data1['countpoint'];
		$sngaz1 = $data['sngaz1'];
		$sngaz2 = $data['sngaz2'];
		$sngaz3 = $data['sngaz3'];
		$name[1] = $data['gname1'];
		$name[2] = $data['gname2'];
		$name[3] = $data['gname3'];

		// Перевод даты из d-m-Y в Y-m-d
		$dategaz1 = date('Y-m-d',strtotime($data['dategaz1']));
		$dategaz2 = date('Y-m-d',strtotime($data['dategaz2']));
		$dategaz3 = date('Y-m-d',strtotime($data['dategaz3']));

		// get user account id
		$sql = "SELECT account_id
              FROM #__tsj_account
              WHERE user_id ='" . $this->username . "';";

		$this->db->setQuery( $sql );
		$row =& $this->db->loadObject();

		if (!$result = $this->db->query()) {
			echo 'Не заполнены дополнительные базы данных. Обратитесь к администратору.';
			//echo $this->db->stderr();
			return false;
		}

		$account_id = $row->account_id;

		// set the data into a query to update the record
		$sql = "SELECT office_counter_id
              FROM #__tsj_gaz_office t1
              WHERE t1.account_id = '". $account_id ."' AND
              			t1.ser_num_p1 = '". $sngaz1 ."' AND
              			t1.ser_num_p2 = '". $sngaz2 ."' AND
              			t1.ser_num_p3 = '". $sngaz3 ."' AND
              			t1.counts = '". $countpoint . "';";

		$this->db->setQuery( $sql );
		$row =& $this->db->loadResult();

		if (!$result = $this->db->query()) {
			JError::raiseError(500, $this->db->getErrorMsg());
			//echo $this->db->stderr();
			return false;
		}

		// Определяем количество записей
		//$nrow = count($row);


		// добавить
		if($row != 0)
		{
			//echo 'Обновлено.';
			$sql = "UPDATE #__tsj_gaz_office
       SET gaz_name_1='$name[1]',gaz_name_2='$name[2]',gaz_name_3='$name[3]',
       	date_in_p1='$dategaz1',date_in_p2='$dategaz2',date_in_p2='$dategaz2'
       WHERE office_counter_id = '".$row."';";

			$this->db->setQuery( $sql );

		}
		else
		{
			//echo 'Сохранено.' . date('Y-m-d',strtotime($datehotgaz));
			// Сохраняем серийные номера и другую информацию
			$sql = "INSERT INTO #__tsj_gaz_office
                        (account_id, counts, gaz_name_1,ser_num_p1, date_in_p1,
                                          gaz_name_2,ser_num_p2, date_in_p2,
                                          gaz_name_3,ser_num_p3, date_in_p3) 
                    VALUES('$account_id','$countpoint','$name[1]','$sngaz1', '$dategaz1',
                                                '$name[2]','$sngaz2', '$dategaz2',
                                                '$name[3]','$sngaz3', '$dategaz3')";
			$this->db->setQuery( $sql );
		}

		// Проверяем на ошибки
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