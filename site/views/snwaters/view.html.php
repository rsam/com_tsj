<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс вида
jimport('joomla.application.component.view');

/**
 * HTML View class for the TSJ Serial Number Component, Water
 */
class TSJViewSNWaters extends JView
{
   public $dataofsn;
   public $params;
   public $form;
   public $username;
   
   public function __construct($config)
   {
      parent::__construct($config);
      // Чтение username из таблицы User
      $user = &JFactory::getUser();
      $this->username = $user->get('username');
      if($this->username == null) $this->username = 0;
      
      ## only for test
      //$this->username = 6334;
   }
   
   // Overwriting JView display method
   function display($tpl = null)
   {
      // Assign data to the view
      $dataofsn = $this->get('DataOfSN');
      $this->dataofsn = $dataofsn;

      // Получим параметры компонента вызвав метод getParams
      $app = &JFactory::getApplication();
      $this->params = $app->getParams();

      //$dispatcher = JDispatcher::getInstance();
      $this->form     = $this->get('Form');

      // Check for errors.
      if (count($errors = $this->get('Errors')))
      {
         JError::raiseError(500, implode('<br />', $errors));
         return false;
      }

      // Display the view
      parent::display($tpl);
   }
}