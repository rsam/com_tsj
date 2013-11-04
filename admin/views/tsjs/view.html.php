<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');
jimport( 'joomla.html.pagination' );
jimport( 'joomla.html.toolbar' );

JLoader::register('TSJsHelper', JPATH_COMPONENT.'/helpers/tsjs.php');
/**
 * TSJs View
 */
class TSJViewTSJs extends JViewLegacy
{
	//public $layout='';

	//список записей
	protected $items;
	//объект постраничной навигации
	protected $pagination;

	protected $dbuser;
	
	public $param;

	/**
	 * TSJs view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$form = $this->get('Form');
		$item = $this->get('Item');
		$state = $this->get('State');
		$pagination = $this->get('Pagination');
		$this->param = $this->get('Params');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// Assign the Data
		$this->form = $form;
		$this->item = $item;
		$this->state = $state;

		// Get data from the model
		if ($this->getLayout() == 'city')
		{
			$this->cityitems = $this->get('CityItems');
			$this->setLayout('city');
			//$layout = 'city';
		}
		else if ($this->getLayout() == 'street')
		{
			$this->streetitems = $this->get('StreetItems');
			$this->setLayout('street');
			//$layout = 'street';
		}
		else if ($this->getLayout() == 'address')
		{
			$this->addressitems = $this->get('AddressItems');
			$this->setLayout('address');
			//$layout = 'address';
		}
		else if ($this->getLayout() == 'account')
		{
			$this->accountitems = $this->get('AccountItems');
			$this->setLayout('account');
			//$layout = 'account';
		}
		else
		{
			$this->items = $this->get('Items');
			$this->setLayout('tsjs');
			//$layout = 'tsjs';
			//$this->items = $this->get('Item');
			//$this->setLayout('tsjs');
				
		}

		//$this->sortDirection = $state->get('filter_order_Dir');
		//$this->sortColumn = $state->get('filter_order');

		$this->pagination = $pagination;

		// Set the toolbar
		$this->addToolBar();

		TSJsHelper::addSubmenu(JRequest::getCmd('view', 'TSJs'));
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
		// Заголовок
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'));
		//JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'), 'generic.png');

		// Кнопки
		$toolbar = JToolBar::getInstance('toolbar');

		if ($this->getLayout() == 'street')
		{
			JToolBarHelper::deleteListX('Вы действительно хотите удалить выбранные записи ?', 'street.remove');
			JToolBarHelper::editListX('street.edit');
			JToolBarHelper::addNewX('street.add');
		}
		else if ($this->getLayout() == 'city')
		{
			JToolBarHelper::deleteListX('Вы действительно хотите удалить выбранные записи ?', 'city.remove');
			JToolBarHelper::editListX('city.edit');
			JToolBarHelper::addNewX('city.add');
		}
		else if ($this->getLayout() == 'address')
		{
			JToolBarHelper::deleteListX('Вы действительно хотите удалить выбранные записи ?', 'address.remove');
			JToolBarHelper::editListX('address.edit');
			JToolBarHelper::addNewX('address.add');
		}
		else if ($this->getLayout() == 'account')
		{
			JToolBarHelper::deleteListX('Вы действительно хотите удалить выбранные записи ?', 'account.remove');
			JToolBarHelper::editListX('account.edit');
			JToolBarHelper::addNewX('account.add');
		}

		JToolBarHelper::divider();
		$toolbar->addButtonPath(JPATH_COMPONENT.'/'.'buttons');
		$toolbar->loadButtonType('Import', true);
		$toolbar->appendButton('Import', 'tsjs-import', 'COM_TSJ_CONFIG_IMPORT', 'tsjs.import');

		$doc = JFactory::getDocument();
		//$icon_48_import = " .icon-48-tsjs {background:url(components/com_tsj/images/header/icon-48-importer.png) no-repeat; }";
		//$doc->addStyleDeclaration($icon_48_import);
		$icon_32_import = " .icon-32-tsjs-import {background:url(components/com_tsj/images/importer.png) no-repeat; }";
		$doc->addStyleDeclaration($icon_32_import);
		JToolBarHelper::divider();

		// Options button.
		if (JFactory::getUser()->authorise('core.admin', 'com_tsj'))
		{
			JToolBarHelper::preferences('com_tsj');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help( 'Components_TSJ', true );
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