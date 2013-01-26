<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

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

	protected function getListQuery()
	{
		// Create a new query object.
		$query = $this->getDbo()->getQuery( true );
		//выбираем
		$layout = JRequest::getVar( 'layout');
		 
		if($layout == 'street'){
			$query->select('*')->from('#__tsj_street');
		}
		else if($layout == 'address'){
			$query->select('*')->from('#__tsj_address');
		}
		else if($layout == 'account'){
			$query->select('*')->from('#__tsj_account');
		}
		else $query->select('*')->from('#__tsj_city');
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
			//$query = 'SELECT * FROM #__tsj_city ORDER BY city' . ' ' . 'asc';
			$query->select('*');
			$query->from('#__tsj_city');
			 
			$listOrder = $this->state->get('list.ordering','address_id');
			$listDirn = $this->state->get('list.direction','asc');
			 
			//echo "lim=".$this->limit;
			//echo "start=".$this->limitstart . "<br>";
			$query->order($listOrder . ' ' . $listDirn);
			//echo "orderCol=".$listOrder;
			//echo "orderDirn=".$listDirn."<br>";

			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
			$this->_city = $this->_getList( $query );
			else
			$this->_city = $this->_getList( $query, $this->limitstart, $this->limit);
			//$this->_city = $this->_getList( $query );
		}

		return $this->_city;
	}

	function getStreetItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_street ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			//$orderDir = $this->state->get('list.direction','asc');
			$query = $this->getDbo()->getQuery( true );
			//$query = 'SELECT * FROM #__tsj_street ORDER BY street' . ' ' . 'asc';
			$query->select('*');
			$query->from('#__tsj_street');

			$listOrder = $this->state->get('list.ordering','address_id');
			$listDirn = $this->state->get('list.direction','asc');
			
			//echo "lim=".$this->limit;
			//echo "start=".$this->limitstart . "<br>";
			$query->order($listOrder . ' ' . $listDirn);
			//echo "orderCol=".$listOrder;
			//echo "orderDirn=".$listDirn."<br>";
			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
			$this->_street = $this->_getList( $query );
			else
			$this->_street = $this->_getList( $query, $this->limitstart, $this->limit);
			//$this->_street = $this->_getList( $query );
		}

		return $this->_street;
	}

	function getAddressItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_address ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');

			//$db = JFactory::getDBO();
			//echo "lim=".$this->limit;
			//echo "start=".$this->limitstart . "<br>";
			//$query = $db->getQuery(true);
			/*         $query = 'SELECT  #__tsj_address.address_id,
			 #__tsj_city.city,
			 #__tsj_street.street,
			 #__tsj_address.house,
			 #__tsj_address.office
			 FROM #__tsj_address
			 INNER JOIN #__tsj_city ON #__tsj_address.city_id = #__tsj_city.city_id
			 INNER JOIN #__tsj_street ON #__tsj_street.street_id = #__tsj_address.street_id
			 ORDER BY #__tsj_city.city, #__tsj_street.street, #__tsj_address.house, #__tsj_address.office;';
			 */
			$query = $this->getDbo()->getQuery( true );
			//выбираем
			$query->select('*')->from('#__tsj_address');
			$query->innerJoin('#__tsj_city ON #__tsj_address.city_id = #__tsj_city.city_id');
			$query->innerJoin('#__tsj_street ON #__tsj_street.street_id = #__tsj_address.street_id');
			 
			//$db->setQuery((string)$query);
			//$this->_address = $db->loadObjectList();

			//$this->_pagination = new JPagination($total, $limitstart, $count);
			$listOrder = $this->state->get('list.ordering','address_id');
			$listDirn = $this->state->get('list.direction','asc');

			//echo "orderCol=".$listOrder;
			//echo "orderDirn=".$listDirn."<br>";

			//$query->order( $this->getDbo()->escape( $orderCol . ' ' . $orderDirn ) );
			//include the ordering on the query
			$query->order($listOrder . ' ' . $listDirn);
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
		/*select *
		 from #__tsj_account
		 inner join #__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id
		 inner join #__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id
		 inner join #__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id;*/

		if (empty( $this->_acount ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');
				
			$query = $this->getDbo()->getQuery( true );
			//$db = JFactory::getDBO();
			//$query = $db->getQuery(true);
			$query->select('*');
			$query->from('#__tsj_account');
			$query->innerJoin('#__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id');
			$query->innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id');
			$query->innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
			$query->innerJoin('#__users on #__tsj_account.user_id = #__users.id');
			//$query->order('#__tsj_city.city, #__tsj_street.street, #__tsj_address.house, #__tsj_address.office;');
			//$db->setQuery((string)$query);
			 
			$listOrder = $this->state->get('list.ordering','address_id');
			$listDirn = $this->state->get('list.direction','asc');
			//echo "lim=".$this->limit;
			//echo "start=".$this->limitstart . "<br>";
			$query->order($listOrder . ' ' . $listDirn);
			//echo "orderCol=".$listOrder;
			//echo "orderDirn=".$listDirn."<br>";
			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
			$this->_account = $this->_getList( $query );
			else
			$this->_account = $this->_getList( $query, $this->limitstart, $this->limit);
			//$this->_account = $db->loadObjectList();
			 
			//$query = 'SELECT * FROM #__tsj_account';
			//$this->_account = $this->_getList( $query );
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
}