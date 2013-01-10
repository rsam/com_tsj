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
   public $lic = -1;
   
   // Метод display выполниться если в адресной строке не указана задача task
   function display( $tpl = true )
   {
      
       //$view = JRequest::getCmd('view', 'lic');
      //$layout = JRequest::getCmd('layout', 'main');
      //$id      = JRequest::getInt('id');
      
      $mName = 'lic';
   	if ($model = $this->getModel($mName)) {
		}
		else echo "Ошибка!!! Нет модели.";
		
      $row = $model->getDataOfLic();
      //print_r($row);
      if(empty($row))
      {
         $this->lic = -1;
         echo '<h2>Внимание!!! Ошибка. Пользователь не обнаружен в базе лицевых счетов.</h2>';
      }
      else
      {
         foreach ($row as $rows)
         {
         }
         if($rows->lic == 1) $this->lic = 1;
         else $this->lic = 0;
      }
      //echo $this->lic;
      JRequest::setVar('lic', $this->lic);
      // задаем вид по умолчанию для компонента если в адресной строке не будет передан view
      //$this->default_view = 'tsj';
      // получаем текущий вид и передаем ему управление
      parent::display( $tpl );
   }
}