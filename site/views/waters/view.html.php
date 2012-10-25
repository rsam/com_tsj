<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс вида
jimport('joomla.application.component.view');

/**
 * HTML View class for the TSJ Component, Water
 */
class TSJViewWaters extends JView
{
   public $dataofsn;
   public $dataofcounter;
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
   
   // Переопределяем JView display метод
   function display($tpl = null)
   {
      // Получим данные для вида из модели вызвав метод модели getDataOfSN
      $dataofsn = $this->get('DataOfSN');
      $this->dataofsn = $dataofsn;

      // Получим данные для вида из модели вызвав метод модели getDataOfCounters
      $dataofcounter = $this->get('DataOfCounters');
      $this->dataofcounter = $dataofcounter;

      // Получим параметры компонента вызвав метод getParams
      $app = &JFactory::getApplication();
      $this->params = $app->getParams();

      //$dispatcher = JDispatcher::getInstance();

      // Получим данные формы из модели
      $this->form = $this->get('Form');

      // Проверка на ошибки
      if (count($errors = $this->get('Errors')))
      {
         JError::raiseError(500, implode('<br />', $errors));
         return false;
      }

      // Отобразим все через вид
      parent::display($tpl);
   }
}