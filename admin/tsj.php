<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_zhyandexmap')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// require helper file
JLoader::register('tsjHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'tsj.php');



// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by ZhYandexMap
$controller = JController::getInstance('tsj');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
