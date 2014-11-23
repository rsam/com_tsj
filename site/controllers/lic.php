<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Controller
 */
class TSJControllerLic extends JControllerForm
{
	public $lic = '';
	 
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	/*function __construct()
	 {
	 parent::__construct();
	  
	 // Регистрация дополнительных задач
	 //$this->registerTask('add', 'edit');
	 //$this->setRedirect(JRoute::_('index.php?option=com_tsj&view=lic&layout=default&id='.JFactory::getUser()->id, false));
	 }*/
	 
	 
	public function settask($tsk)
	{
		$this->tsk = $tsk;
	}
	 
	/**
	 * Method to set a form data.
	 *
	 * @return  constant  true.
	 *
	 * @since   11.1
	 */
	// Метод вызывается при нажатии кнопки формы
	public function save()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables
		//$app    = JFactory::getApplication();
		$model  = $this->getModel('lic');

		// Get the data from the form POST
		$data = JRequest::getVar('checklic', array(), 'post', 'array');
		$tsk = JRequest::getVar('subtask', array(), 'post');


		//$data1 = JRequest::get( 'post' );
		//$checkbox_arr = array_map('intval', $data1);
		// Now update the loaded data to the database via a function in the model
		//$upditem        = $model->setDataOfSN($data, $data1);

		//print_r($data);
		// check if ok and display appropriate message.  This can also have a redirect if desired.
		if (!empty($data[0]))
		{
			if($data[0] == '1' ) $this->lic = '1';
			else $this->lic = '0';
			 
			$upditem        = $model->setDataOfLic($this->lic);
			if($upditem)
			{
				//echo "<h2>Спасибо. Теперь Вы можете пользоваться функциями системы.</h2>";
				$this->setRedirect(JRoute::_('index.php?option=com_tsj&view='.$tsk.'&layout=default&id='.JFactory::getUser()->id, false));
				//$this->setRedirect(JRoute::_(JURI::root().'index.php', false));
			}
			else
			echo "<h2>Ошибка при сохранении данных.</h2>";
		}
		else
		{
			echo "<h2>Вы не можете пользоваться функциями системы без подтверждения согласия на использование персональных данных на сайте</h2>";
		}

		return true;
	}
}