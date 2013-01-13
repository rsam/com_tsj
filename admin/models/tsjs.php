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
   var $_city;
   var $_street;
   var $_address;
   var $_office;
   var $_acount;

   protected function getListQuery()
   {
      // Create a new query object.    
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      // Select some fields
      $query->select('city_id,city');
      // From the table
      $query->from('#__tsj_city');
      return $query;
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

         $query = 'SELECT  #__tsj_address.address_id,
                              #__tsj_city.city,
                              #__tsj_street.street,
                              #__tsj_address.house,
                              #__tsj_address.office
                     FROM #__tsj_address
                     INNER JOIN #__tsj_city ON #__tsj_address.city_id = #__tsj_city.city_id
                     INNER JOIN #__tsj_street ON #__tsj_street.street_id = #__tsj_address.street_id
                     GROUP BY #__tsj_address.address_id
                     ORDER BY #__tsj_city.city, #__tsj_street.street, #__tsj_address.house, #__tsj_address.office;';

         $this->_address = $this->_getList( $query );
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
}