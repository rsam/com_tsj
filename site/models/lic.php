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
 * TSJ Model Water
 */
class TSJModelLic extends JModelForm
{
   /**
    * @var string username eq. account
    */
   public $user_id;

   /**
    * @var pointer to global object database
    */
   public $db;
   
   /**
    * Constructor for set class variables
    */
   public function __construct($config)
   {
      parent::__construct($config);
      
      // Чтение username из таблицы User
      $user = &JFactory::getUser();

      $this->user_id = $user->get('id');
      if($this->user_id == null) $this->user_id = 0;
      
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
    * Returns a data of water counters.
    *
    * @return  JTable   A database object
    * @since   2.5
    */
   public function getDataOfLic()
   {
      //if (!isset($this->msg))
      {
         // Подготовка запроса на получение данных счетчиков воды
         $sql = "SELECT  #__tsj_account.lic
                 FROM #__tsj_account
                 WHERE  #__tsj_account.user_id = $this->user_id;";

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
            return 0;
         }
         
         //$this->msg = true;
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
      $form = $this->loadForm('com_tsj.lic', 'lic', array('control' => 'lic', 'load_data' => true));
      if (empty($form)) {
         return false;
      }
      return $form;

   }
   
   /**
    * Returns a data of water counters.
    *
    * @return  JTable   A database object
    * @since   2.5
    */
   public function setDataOfLic($data)
   {
      //if (!isset($this->msg))
      {
         $sql = " UPDATE #__tsj_account
                  SET   #__tsj_account.lic=$data
                  WHERE  #__tsj_account.user_id = $this->user_id;";
         
         $this->db->setQuery( $sql );
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
         //$this->msg = true;
      }

      return true;
   }
}