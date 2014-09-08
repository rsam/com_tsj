<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Controller
 */
class TSJControllerAddress extends JControllerForm
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
	function save($key = null, $urlVar = null)
	{
		//$model = $this->getModel('address');
		if (parent::save('address.save')) {
			$msg = JText::_( 'Address Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Address' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_tsj&view=tsjs&layout=address';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('address');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Addresss Could not be Deleted' );
		} else {
			$msg = JText::_( 'Address(s) Deleted' );
		}
		 
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=address', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel($key = null)
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=address', $msg );
	}
}