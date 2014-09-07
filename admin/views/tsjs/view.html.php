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
class TSJViewTSJs extends JViewAbstract
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

		TSJsHelper::addSubmenu('tsjs');
				
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

		// Display the template
		if (version_compare(JPlatform::RELEASE, '12', '>='))
		{
			$this->sidebar = JHtmlSidebar::render();
		}
		
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		$state	= $this->get('State');
		$canDo	= TSJsHelper::getActions('com_tsjs', 'category', $state->get('filter.category_id'));
		$user	= JFactory::getUser();
		
		// Заголовок
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'));
		//JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'), 'generic.png');

		// Кнопки
		$toolbar = JToolBar::getInstance('toolbar');
		$toolbar->addButtonPath(JPATH_COMPONENT.DS.'buttons');
		
		if ($this->getLayout() == 'street')
		{
			JToolBarHelper::addNew('street.add');
			if ($canDo->get('core.edit'))			
			{
				JToolBarHelper::editList('street.edit');
			}
			//if ($canDo->get('core.remote'))			
			{
				JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'street.remove');
			}
		}
		else if ($this->getLayout() == 'city')
		{
			if ($canDo->get('core.create')) {
				JToolBarHelper::addNew('city.add');
			}
			JToolBarHelper::editList('city.edit');
			JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'city.remove');
		}
		else if ($this->getLayout() == 'address')
		{
			JToolBarHelper::addNew('address.add');
			JToolBarHelper::editList('address.edit');
			JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'address.remove');
		}
		else if ($this->getLayout() == 'account')
		{
			JToolBarHelper::addNew('account.add');
			JToolBarHelper::editList('account.edit');
			JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'account.remove');
		}
		else{
		//JToolBarHelper::divider();
		$toolbar->loadButtonType('Import', true);		
		
		if (version_compare(JPlatform::RELEASE, '12', '<')){
			$toolbar->appendButton('Import', 'tsjs-import', 'COM_TSJ_CONFIG_IMPORT', 'tsjs.import',false);
		}
		else{
			$toolbar->appendButton('Import', 'import', 'tsjs-import', 'COM_TSJ_CONFIG_IMPORT', 'tsjs.import', false);		
		}

		$doc = JFactory::getDocument();
		//$icon_48_import = " .icon-48-tsjs {background:url(components/com_tsj/images/header/icon-48-importer.png) no-repeat; }";
		//$doc->addStyleDeclaration($icon_48_import);
		$icon_32_import = " .icon-32-tsjs-import {background:url(components/com_tsj/images/importer.png) no-repeat; }";
		$doc->addStyleDeclaration($icon_32_import);
		
		}

		// Add a batch button
		/*if ($user->authorise('core.create', 'com_tsjs') && $user->authorise('core.edit', 'com_tsjs') && $user->authorise('core.edit.state', 'com_tsjs'))
		{
			JHtml::_('bootstrap.modal', 'collapseModal');
			$title = JText::_('JTOOLBAR_BATCH');

			// Instantiate a new JLayoutFile instance and render the batch button
			$layout = new JLayoutFile('joomla.toolbar.batch');

			$dhtml = $layout->render(array('title' => $title));
			$toolbar->appendButton('Custom', $dhtml, 'batch');
		}*/	
		
		// Options button.
		if (JFactory::getUser()->authorise('core.admin', 'com_tsj'))
		{
			JToolBarHelper::preferences('com_tsj');
			//JToolBarHelper::divider();
		}

		JToolBarHelper::help( 'Components_TSJ', true );		
		
		if (version_compare(JPlatform::RELEASE, '12', '>='))
		{		
			JHtmlSidebar::setAction('index.php?option=com_tsjs&view=tsjs');
		}
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