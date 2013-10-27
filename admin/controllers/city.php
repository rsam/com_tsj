<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Controller
 */
class TSJControllerCity extends JControllerForm
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		 
		// Регистрация дополнительных задач
		//$this->registerTask('add', 'edit');
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		//$model = $this->getModel('city');
		if (parent::save('city.save')) {
			$msg = JText::_( 'City Saved!' );
		} else {
			$msg = JText::_( 'Error Saving City' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_tsj&view=tsjs&layout=city';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('city');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Citys Could not be Deleted' );
		} else {
			$msg = JText::_( 'City(s) Deleted' );
		}
		 
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=city', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=city', $msg );
	}
}