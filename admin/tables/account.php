<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * TSJ Table class
 */
class TSJTableAccount extends JTable
{
   /**
    * Primary Key
    *
    * @var int
    */
   var $account_id = null;

   /**
    * @var string
    */
   var $address_id = null;

   var $user_id = null;
   var $tel = null;
   var $sq = null;
   var $cat = 0;
   var $lic = 0;
   
   //var $city = null;

   /**
    * Constructor
    *
    * @param object Database connector object
    */
   function __construct(&$db)
   {
      parent::__construct('#__tsj_account', 'account_id', $db);
   }

   public function bind($array, $ignore = '')
   {
      if (!isset($array['lic'])){
         $array['lic'] = '0';
      }
      
      return parent::bind($array, $ignore);
   }
   
   /*public function store($updateNulls)
   {
      return parent::store($updateNulls);
   }*/

}