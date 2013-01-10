<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс вида
jimport('joomla.application.component.view');

/**
 * HTML View class for the tsj Component
 */
class TSJViewLic extends JView
{
   // Переопределяем JView display метод
   function display($tpl = null)
   {
      // Вызываем из модели метод getMsg и получим данные
      //$this->msg = $this->get('Msg');
      $this->assign('form', $this->get('Form'));

      // Проверка на ошибки
      if (count($errors = $this->get('Errors')))
      {
         JError::raiseError(500, implode('<br />', $errors));
         return false;
      }

      // Вызываем метод родителя, отображаем вид
      parent::display($tpl);
   }
}