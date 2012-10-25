<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс контроллера
jimport('joomla.application.component.controller');

/**
 * TSJ Component Controller
 */
class TSJController extends JController
{
   // Метод display выполниться если в адресной строке не указана задача task
   function display( $tpl = true )
   {
      // задаем вид по умолчанию для компонента если в адресной строке не будет передан view
      $this->default_view = 'tsj';
      // получаем текущий вид и передаем ему управление
      parent::display( $tpl );
   }
}