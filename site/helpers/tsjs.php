<?php

defined('_JEXEC') or die;

/**
 * TSJ component helper.
 *
 * @package    Joomla.Site
 * @subpackage com_tsj
 * @since      2.5
 */
class TSJsHelper
{
   /**
    * @var string username eq. account
    */
   public $username;

   /**
    * @var pointer to global object database
    */
   public $db;
   
   /**
    * Configure the Linkbar.
    *
    * @param   string   The name of the active view.
    * @return  void
    * @since   2.5
    */
   
   public static function getLic()
   {
        // Чтение username из таблицы User
      $user = &JFactory::getUser();

      $username = $user->get('username');
      if($username == null) $username = 0;
      
      // Возвращаем ссылку на глобальный объект базы данных
      $db = $this->getDBO();
         if (!$db->connected()) {
            echo "Нет соединения с сервером баз данных. Повторите запрос позже";
            jexit();
      }
   }
   
}