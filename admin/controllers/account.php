<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Controller
 */
class TSJControllerAccount extends JControllerForm
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
		//$model = $this->getModel('account');
		 
		//$data = JRequest::get('post');
		//$data['lic'] = JString::trim(JRequest::getVar('lic', '', 'post', 'string', JREQUEST_ALLOWRAW));
		//print_r($data);
		 
		/*   $data = JRequest::getVar('lic12','','POST');
		 $t = JRequest::getVar('jform', array(), 'array');
		 JRequest::setVar($t['lic'],'5','post');
		 print_r($t['lic']);
		 die();
		  
		 if($data == 'on'){
		 print_r($data);
		 JRequest::setVar('lic','on','POST');
		 JRequest::setVar($data['jform']['lic'],'on','POST');
		 $data = JRequest::get('post');
		 print_r($data);
		 }
		 else{
		 print_r('qqq:');
		 JRequest::setVar('lic','off','POST');
		 JRequest::setVar($data['jform']['lic'],'off','POST');
		 $data = JRequest::get('post');
		 print_r($data);
		 }
		  
		 die();*/

		if (parent::save('account.save')) {
			$msg = JText::_( 'Account Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Account' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_tsj&view=tsjs&layout=account';
		$this->setRedirect($link, $msg);
	}
	 
	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('account');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Accounts Could not be Deleted' );
		} else {
			$msg = JText::_( 'Account(s) Deleted' );
		}
		 
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=account', $msg );
	}
	 
	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_tsj&view=tsjs&layout=account', $msg );
	}
}