<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// Set some global property

//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-tsj {background-image: url('/../media/com_tsj/images/hello_icon48.png');}');

// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by TSJ
$controller = JController::getInstance('TSJ');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();