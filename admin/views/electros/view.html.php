<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * TSJs View
 */
class TSJViewElectros extends JViewLegacy
{
	/**
	 * Water view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		//$items = $this->get('Items');
		//$pagination = $this->get('Pagination');
		$this->form     = $this->get('Form');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		//$this->items = $items;
		//$this->pagination = $pagination;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		// Выводим заголовок
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_ELECTROS'));

		$bar = JToolBar::getInstance('toolbar');
		$bar->appendButton('Popup', 'options', 'COM_TSJ_BTN_MY_SETTINGS', 'index.php?option=com_tsj&amp;view=econfig&amp;tmpl=component', 850, 400);

		//Выводим кнопку настройки
		if (JFactory::getUser()->authorise('core.admin', 'com_tsj')) {
			JToolBarHelper::preferences('com_tsj');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help( 'com_tsj', true );
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_TSJ_ADMINISTRATION'));
	}
}