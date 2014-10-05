<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
if (version_compare(JPlatform::RELEASE, '12', '>=')) JHtml::_('behavior.tabstate');
// Set some global property

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_tsj'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-tsj {background-image: url('/../media/com_tsj/images/jkx16.png');}');

// import joomla controller library
if (version_compare(JPlatform::RELEASE, '12', '<'))
{
	jimport('joomla.application.component.controller');
	jimport('joomla.application.component.view');
	
    //JFactory::getApplication()->enqueueMessage('Debug: Create JController & JView class');
    
	if (!class_exists('JControllerAbstract'))
	{
		abstract class JControllerAbstract extends JController {}
	}
	if (!class_exists('JViewAbstract'))
	{
		abstract class JViewAbstract extends JView {}
	}
}
else
{
	if (!class_exists('JControllerAbstract'))
	{
		abstract class JControllerAbstract extends JControllerLegacy {}
	}
	if (!class_exists('JViewAbstract'))
	{
		abstract class JViewAbstract extends JViewLegacy {}
	}
}

$input = JFactory::getApplication()->input;
// Get an instance of the controller prefixed by TSJ
$controller = JControllerAbstract::getInstance('tsj');

// Perform the Request task
$controller->execute($input->get('task'));
//JFactory::getApplication()->enqueueMessage('Debug: Task='. JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();