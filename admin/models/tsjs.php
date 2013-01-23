<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
//jimport('joomla.application.component.modellist');
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
jimport( 'joomla.application.component.modellegacy' );

//jimport('joomla.html.pagination');

/**
 * TSJList Model
 */
class TSJModelTSJs extends JModelLegacy
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
    	$query->select('*')->from('#__tsj_address');
    	return $query;
   }
   
public function __construct( $config = array() )
  {
    parent::__construct( $config );
    $app = JFactory::getApplication();
    //получаем объект для обработки пользовательского ввода
    $input = $app->input;
    //Получаем текущую страницу
    $this->limitstart = $input->get( 'start', 0 );
    //Определяем количество строк выводимых на страницу
    $this->limit = $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg( 'list_limit' ), 'uint' );
  }
   
   function getCityItems()
   {
      // Загружаем данные, если они еще не загружены
      if (empty( $this->_city ))
      {
         $query = 'SELECT * FROM #__tsj_city ORDER BY city' . ' ' . 'asc';
         $this->_city = $this->_getList( $query );
      }

      return $this->_city;
   }

   function getStreetItems()
   {
      // Загружаем данные, если они еще не загружены
      if (empty( $this->_street ))
      {
         //$orderDir = $this->state->get('list.direction','asc');
         $query = 'SELECT * FROM #__tsj_street ORDER BY street' . ' ' . 'asc';

         $this->_street = $this->_getList( $query );
      }

      return $this->_street;
   }

   function getAddressItems()
   {
      // Загружаем данные, если они еще не загружены
      if (empty( $this->_address ))
      {
			//$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			//$total = 20;
			
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
         $query = 'SELECT  #__tsj_address.address_id,
                              #__tsj_city.city,
                              #__tsj_street.street,
                              #__tsj_address.house,
                              #__tsj_address.office
                     FROM #__tsj_address
                     INNER JOIN #__tsj_city ON #__tsj_address.city_id = #__tsj_city.city_id
                     INNER JOIN #__tsj_street ON #__tsj_street.street_id = #__tsj_address.street_id
                     ORDER BY #__tsj_city.city, #__tsj_street.street, #__tsj_address.house, #__tsj_address.office
                     LIMIT ' . $this->limitstar . ',10;';

         $db->setQuery((string)$query);
          //$this->_address = $this->_getList( $this->getListQuery(), $this->limitstart, $this->limit );
         $this->_address = $db->loadObjectList();

			//$this->_pagination = new JPagination($total, $limitstart, $count);

         //$this->_address = $this->_getList( $query, $this->limitstart, $this->limit);
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
         $db = JFactory::getDBO();
         $query = $db->getQuery(true);
         $query->select('*');
         $query->from('#__tsj_account');
         $query->innerJoin('#__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id');
         $query->innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id');
         $query->innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
         $query->innerJoin('#__users on #__tsj_account.user_id = #__users.id');
         $query->order('#__tsj_city.city, #__tsj_street.street, #__tsj_address.house, #__tsj_address.office;');
         $db->setQuery((string)$query);
         $this->_account = $db->loadObjectList();
         
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
	* Возвращает объект постраничной навигации.
	* 
	* @return object JPagination.
	*/
//Метод для получения объекта пагинации
  public function getPagination()
  {
    //подключаем класс пагинации
    jimport( 'joomla.html.pagination' );
    //возвращаем объект пагинации первый параметр это общее количество записей в таблице по нашему запросу
    //второй текущая страниц и последний это количество записей выводимых на странице
    return new JPagination( $this->getTotal(), $this->limitstart, $this->limit );
  }
  
 private function getTotal()
  {
    return $this->_getListCount( $this->getListQuery() );
  }
}