<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс вида
jimport('joomla.application.component.view');

/**
 * HTML View class for the TSJ Component, Electro
 */
class TSJViewElectros extends JViewLegacy
{
	public $dataofsn;
	public $dataofcounter;
	public $params;
	public $form;
	 
	public $user;
	public $username;
	 
	public $lic;
	 
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Чтение username из таблицы User
		$user = &JFactory::getUser();
		$this->username = $user->get('id');
		$this->user = $user->get('username');
		if($this->username == null) $this->username = 0;

		## only for test
		//$this->username = 6334;

	}
	 
	// Переопределяем JViewLegacy display метод
	function display($tpl = null)
	{
		$app = &JFactory::getApplication();

		$this->lic = JRequest::getVar('lic');
		//echo $this->lic;

		if($this->lic == 0){
			// redirect to lic
			$app->redirect('index.php?option=com_tsj&view=lic&task=electros');
		}

		// Получим данные для вида из модели вызвав метод модели getDataOfSN
		$dataofsn = $this->get('DataOfSN');
		$this->dataofsn = $dataofsn;

		// Получим данные для вида из модели вызвав метод модели getDataOfCounters
		$dataofcounter = $this->get('DataOfCounters');
		$this->dataofcounter = $dataofcounter;

		// Получим параметры компонента вызвав метод модели getParams
		$this->params = $this->get('Params');
		//print_r($this->params);
		//$dispatcher = JDispatcher::getInstance();

		// Получим данные формы из модели
		$this->form = $this->get('Form');

		// Проверка на ошибки
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// Отобразим все через вид
		parent::display($tpl);
	}
}