<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// Set some global property

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_tsj'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-tsj {background-image: url('/../media/com_tsj/images/jkx16.png');}');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by TSJ
$controller = JController::getInstance('TSJ');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();