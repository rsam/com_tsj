<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');
jimport( 'joomla.html.pagination' );
jimport( 'joomla.html.toolbar' );

/**
 * TSJs View
 */
class TSJViewTarifs extends JViewLegacy
{
	//список записей
	protected $items;
	//объект постраничной навигации
	protected $pagination;

	/**
	 * Tarifs view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$form = $this->get('Form');
		$items = $this->get('Items');
		$state = $this->get('State');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->form = $form;
		$this->items = $items;
		$this->state = $state;
		$this->pagination = $pagination;

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
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TARIF'));

		//Выводим кнопку настройки
		/*if (JFactory::getUser()->authorise('core.admin', 'com_tsj')) {
		JToolBarHelper::preferences('com_tsj');
		JToolBarHelper::divider();
		}*/

		JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'tarif.remove');
		JToolBarHelper::editList('tarif.edit');
		JToolBarHelper::addNew('tarif.add');

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