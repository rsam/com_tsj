<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс контроллера controllerform
jimport('joomla.application.component.controllerform');

class TSJControllerSNGazs extends JControllerForm
{
	/**
	 * The context for storing internal data, e.g. record.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $context;

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   11.1
	 */
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		if (empty($name))
		{
			$name = $this->context;
		}
		return parent::getModel($name, $prefix, array('ignore_request' => false));
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
		$model  = $this->getModel('sngazs');

		// Get the data from the form POST
		$data = JRequest::getVar('sngazs', array(), 'post', 'array');
		//print_r($data);
		$data1 = JRequest::get( 'post' );
		// Now update the loaded data to the database via a function in the model
		$upditem        = $model->setDataOfSN($data, $data1);

		// check if ok and display appropriate message.  This can also have a redirect if desired.
		if ($upditem)
		{
			echo "<h2>Данные сохранены</h2>";
		}
		else
		{
			echo "<h2>Ошибка при сохранении данных</h2>";
		}

		return true;
	}

}