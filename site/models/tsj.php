<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс modelitem
jimport('joomla.application.component.modelitem');

/**
 * TSJ Model
 */
class TSJModelTSJ extends JModelItem
{
   /**
    * @var string msg
    */
   protected $msg;

   /**
    * Returns a reference to the a Table object, always creating it.
    *
    * @param	type	The table type to instantiate
    * @param	string	A prefix for the table class name. Optional.
    * @param	array	Configuration array for model. Optional.
    * @return	JTable	A database object
    * @since	2.5
    */
   public function getTable($type = 'TSJ', $prefix = 'TSJTable', $config = array())
   {
      return JTable::getInstance($type, $prefix, $config);
   }
   /**
    * Get the message
    * @return string The message to be displayed to the user
    */
   public function getMsg()
   {
      if (!isset($this->msg))
      {
         /*$id = JRequest::getInt('city_id', 1);
          // Get a TableTSJ instance
          $table = $this->getTable();

          // Load the message
          $table->load($id);

          // Assign the message
          $this->msg = $table->city;
          */
          
         // Выдаем информационное сообшение
         $this->msg = 'Empty message from model TSJModel';
      }
      
      return $this->msg;
   }
}