<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс контроллера
jimport('joomla.application.component.controller');

// Создаем экземпляр контроллера по умолчанию TSJ
$controller = JControllerLegacy::getInstance('tsj');
$controller->registerDefaultTask('tsj');
// Контроллер выполняет задачу task переданную ему через переменную task в адресной строке
//$controller->execute(JRequest::getCmd('task'));
$controller->execute(JFactory::getApplication()->input->get('task'));
// Передаем управление контроллеру
$controller->redirect();