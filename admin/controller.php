<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

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
		$view = JRequest::getCmd('view', 'TSJs');
		$layout = JRequest::getCmd('layout', 'main');
		$id      = JRequest::getInt('id');

		// set default view if not set
		JRequest::setVar('view', $view);

		// call parent behavior
		parent::display($cachable,$urlparams);
		return $this;		
	}
}