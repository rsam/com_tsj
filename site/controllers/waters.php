<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Подключаем класс контроллера controllerform
jimport('joomla.application.component.controllerform');

class TSJControllerWaters extends JControllerForm
{
	/**
	 * The context for storing internal data, e.g. record.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $context = 'waters';

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
	public function submit()
	{
		// Проверка токена
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Инициализация переменных
		$app    = JFactory::getApplication();
		$model  = $this->getModel('waters');

		// Получение данных формы waters (waters.xml) POST
		$data = JRequest::getVar('waters', array(), 'post', 'array');

		// Сохраним данные из формы в базе данных через метод модели setDataOfCounters
		$upditem        = $model->setDataOfCounters($data);

		// Если при сохранении нет ошибок или были ошибки, выведем соответствующее сообщение.
		if ($upditem)
		{
			echo "<h2>Показания индивидуальных счетчиков воды сохранены</h2>";
		}
		else
		{
			echo "<h2>Ошибка при сохранении показаний индивидуальных счетчиков воды</h2>";
		}

		return true;
	}

}