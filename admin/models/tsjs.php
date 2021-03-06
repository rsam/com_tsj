<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
define('Engine','Engine');

/**
 * TSJList Model
 */
class TSJModelTSJs extends JModelList
{
	//текущая страница
	private $limitstart;
	//количество записей на странице
	private $limit;


	var $_city;
	var $_street;
	var $_address;
	var $_office;
	var $_acount;
	public $dbuser;

	protected function getListQuery()
	{
		// Create a new query object.
        $db    = JFactory::getDbo();
		$query = $db->getQuery( true );
		//выбираем
		$layout = JRequest::getVar( 'layout');
			
		if($layout == 'street'){
			$query->select('*')->from('#__tsj_street');
		}
		else if($layout == 'address'){
			$query->select('*')->from('#__tsj_address')->
                innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id')->
                innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
		}
		else if($layout == 'account'){
			$query->select('*')->from('#__tsj_account')->
                innerJoin('#__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id')->
                innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id')->
                innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id')->
                innerJoin('#__users on #__tsj_account.user_id = #__users.id');
		}
		else {
            $query->select('*')->from('#__tsj_city');
        }
        
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'greeting');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        
		return $query;
	}

	public function __construct( $config = array() )
	{
		$app = JFactory::getApplication();
		//получаем объект для обработки пользовательского ввода
		$input = $app->input;
		//Получаем текущую страницу
		$this->limitstart = $input->get( 'start', 0 );
		//Определяем количество строк выводимых на страницу
		$this->limit = $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg( 'list_limit' ), 'uint' );

		//Устанавливаем поля по которым будет сортировка
		$layout = JRequest::getVar( 'layout', 'address');
		if($layout == 'street'){
			$config['filter_fields'] = array( 'street_id', 'street');
		}
		else if($layout == 'address'){
			$config['filter_fields'] = array( 'address_id', 'city', 'street', 'house');
		}
		else if($layout == 'account'){
			$config['filter_fields'] = array( 'account_id', 'account_num', 'city', 'street', 'name');
		}
		else $config['filter_fields'] = array( 'city_id', 'city');
		/*if ( empty( $config['filter_fields'] ) ) {
		 $config['filter_fields'] = array( 'address_id', 'city', 'street', 'house');
		 }*/

		// Проверка на InnoDB тип таблицы #_users
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		#$query="SHOW TABLE STATUS LIKE '%_users%';";
        $query="SHOW TABLE STATUS LIKE '" . $db->getPrefix() . "users';";
		$db->setQuery((string)$query);
		$row = $db->loadAssocList();
        #echo 'Read DB <_users> format = '.$row[0][Engine];
		if($row[0][Engine] == 'InnoDB'){
			JRequest::setVar($this->dbuser,'InnoDB');
		}

		//echo "layout=".$layout."<br>";
		parent::__construct( $config );
	}

	function getCityItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_city ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');

			$query = $this->getDbo()->getQuery( true );
			$query->select('*');
			$query->from('#__tsj_city');

			$listDirn = $this->state->get('list.direction','asc');

            switch ($this->getState('list.ordering')) {
                case 'city':
                    $query->order('#__tsj_city.city ' . $listDirn);
                    //$join['c'] = true;
                    break;
                default:
                    $query->order('#__tsj_city.city_id ' . $listDirn);
                    $this->setState('list.ordering', 'id');
            }

			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
                $this->_city = $this->_getList( $query );
			else
                $this->_city = $this->_getList( $query, $this->limitstart, $this->limit);
		}

		return $this->_city;
	}

	function getStreetItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_street ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			$query = $this->getDbo()->getQuery( true );
			$query->select('*');
			$query->from('#__tsj_street');

			$listDirn = $this->state->get('list.direction','asc');
            switch ($this->getState('list.ordering')) {
                case 'street':
                    $query->order('#__tsj_street.street ' . $listDirn);
                    break;
                default:
                    $query->order('#__tsj_street.street_id ' . $listDirn);
                    $this->setState('list.ordering', 'id');
            }

			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
                $this->_street = $this->_getList( $query );
			else
                $this->_street = $this->_getList( $query, $this->limitstart, $this->limit);
		}

		return $this->_street;
	}

	function getAddressItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_address ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');

			$query = $this->getDbo()->getQuery( true );
			//выбираем
			$query->select('*')->from('#__tsj_address');
			$query->innerJoin('#__tsj_city ON #__tsj_address.city_id = #__tsj_city.city_id');
			$query->innerJoin('#__tsj_street ON #__tsj_street.street_id = #__tsj_address.street_id');
			$listDirn = $this->state->get('list.direction','asc');

            switch ($this->getState('list.ordering')) {
                case 'house':
                    $query->order('#__tsj_address.house ' . $listDirn);
                    //$join['tt'] = true;
                    break;
                case 'city':
                    $query->order('#__tsj_city.city ' . $listDirn);
                    //$join['c'] = true;
                    break;
                case 'street':
                    $query->order('#__tsj_street.street ' . $listDirn);
                    break;
                default:
                    $query->order('#__tsj_address.address_id ' . $listDirn);
                    $this->setState('list.ordering', 'id');
            }

			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
			$this->_address = $this->_getList( $query );
			else
			$this->_address = $this->_getList( $query, $this->limitstart, $this->limit);
		}

		return $this->_address;
	}

	function getAccountItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_acount ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');

			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('*');
			$query->from('#__tsj_account');
			$query->innerJoin('#__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id');
			$query->innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id');
			$query->innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
			$query->innerJoin('#__users on #__tsj_account.user_id = #__users.id');

			$listDirn = $this->state->get('list.direction','asc');

            switch ($this->getState('list.ordering')) {
                case 'account_id':
                    $query->order('#__tsj_account.account_id ' . $listDirn);
                    break;
                case 'account_num':
                    $query->order('#__tsj_account.account_num ' . $listDirn);
                    //$join['tt'] = true;
                    break;
                case 'city':
                    $query->order('#__tsj_city.city ' . $listDirn);
                    //$join['c'] = true;
                    break;
                case 'street':
                    $query->order('#__tsj_street.street ' . $listDirn);
                    break;
                case 'name':
                    $query->order('#__users.name ' . $listDirn);
                    break;
                default:
                    $query->order('#__tsj_account.account_id ' . $listDirn);
                    $this->setState('list.ordering', 'id');
            }

			// Пагинация. Возвращаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
                $this->_account = $this->_getList( $query );
			else
                $this->_account = $this->_getList( $query, $this->limitstart, $this->limit);
		}

		return $this->_account;
	}


	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed The data for the form.
	 * @since   2.5
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_tsj.edit.tsjs.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}

	/**
	 * Method to populate the state of the model
	 *
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		//call the parent procedure
		$layout = JRequest::getVar( 'layout');

		if($layout == 'street'){
			parent::populateState('street_id', 'asc');
		}
		else if($layout == 'address'){
			parent::populateState('address_id', 'asc');
		}
		else if($layout == 'account'){
			parent::populateState('account_id', 'asc');
		}
		else parent::populateState('city_id', 'asc');
		//parent::populateState($ordering, $direction);
	}

	function getParams()
	{
		$params = array();

		$db	= JFactory::getDBO();
		$db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'water_on';" );
		$row = $db->loadResult();
		// РџСЂРѕРІРµСЂРєР° РЅР° РѕС€РёР±РєРё
		if (!$result = $db->query()) {
			//echo $this->db->stderr();
			return false;
		}
		$params['water_on'] = $row;
		
		$db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'gaz_on';" );
		$row = $db->loadResult();
		// РџСЂРѕРІРµСЂРєР° РЅР° РѕС€РёР±РєРё
		if (!$result = $db->query()) {
			//echo $this->db->stderr();
			return false;
		}
		$params['gaz_on'] = $row;
		
		$db->setQuery( "SELECT cfg_value FROM #__tsj_cfg WHERE cfg_name = 'electro_on';" );
		$row = $db->loadResult();
		// РџСЂРѕРІРµСЂРєР° РЅР° РѕС€РёР±РєРё
		if (!$result = $db->query()) {
			//echo $this->db->stderr();
			return false;
		}
		$params['electro_on'] = $row;
		
	return $params;
	}
	
	public function setDataOfConfig($data)
	{
			// Get the data from the form POST
		//$data = JRequest::getVar('submit', array(), 'post', 'array');

			$db = JFactory::getDBO();
			if (!$db->connected()) {
				echo "Нет соединения с сервером баз данных. Повторите запрос позже";
				jexit();
			}
			// Check for request forgeries.
			//JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
			$db->setQuery(" DELETE FROM #__tsj_cfg WHERE cfg_name = 'water_on'");
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
				
			$db->setQuery("INSERT INTO #__tsj_cfg (cfg_name, cfg_value) 
						VALUES ('water_on'," . $data['water'] . ")" );
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
				
				$db->setQuery(" DELETE FROM #__tsj_cfg WHERE cfg_name = 'gaz_on'");
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
				
			$db->setQuery("INSERT INTO #__tsj_cfg (cfg_name, cfg_value) 
						VALUES ('gaz_on'," . $data['gaz'] . ")" );
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
			
			$db->setQuery(" DELETE FROM #__tsj_cfg WHERE cfg_name = 'electro_on'");
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
				
			$db->setQuery("INSERT INTO #__tsj_cfg (cfg_name, cfg_value) 
						VALUES ('electro_on'," . $data['electro'] . ")" );
			$db->query();
			if ($error = $db->getErrorMsg()) {
				$this->setError($error);
				return false;
			}
			
			return true;
		}
}