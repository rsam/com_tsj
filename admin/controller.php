<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
//jimport('joomla.application.component.controller');

/**
 * General Controller of TSJ component
 */
class TSJController extends JControllerAbstract
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = false)
	{
		$view   = JRequest::getCmd('view', 'tsjs');
		$layout = JRequest::getCmd('layout', 'default');
		$id     = JRequest::getCmd('id');
        
		// set default view if not set
		JRequest::setVar('view', $view);
        //JFactory::getApplication()->enqueueMessage('Debug: TSJController::display view='.$view.' layout='.$layout.' id='.$id); 
        
		// call parent behavior
		parent::display($cachable,$urlparams);
		return $this;		
	}
}