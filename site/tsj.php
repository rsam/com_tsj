<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс контроллера
jimport('joomla.application.component.controller');

// Создаем экземпляр контроллера по умолчанию TSJ
$controller = JController::getInstance('TSJ');

// Контроллер выполняет задачу task переданную ему через переменную task в адресной строке
$controller->execute(JRequest::getCmd('task'));

// Передаем управление контроллеру
$controller->redirect();