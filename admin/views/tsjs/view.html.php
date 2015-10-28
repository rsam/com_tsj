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
	protected $items;
	protected $pagination;
	protected $state;
    public $dbuser;

	/**
	 * TSJs view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->form = $this->get('Form');
		$this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');
		$this->param = $this->get('Params');      
        
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
				
		// Get data from the model
		if ($this->getLayout() == 'city')
		{
			$this->cityitems = $this->get('Items');
			$this->setLayout('city');
			//$layout = 'city';
		}
		else if ($this->getLayout() == 'street')
		{
			$this->streetitems = $this->get('Items');
			$this->setLayout('street');
			//$layout = 'street';
		}
		else if ($this->getLayout() == 'address')
		{
			$this->addressitems = $this->get('Items');
			$this->setLayout('address');
			//$layout = 'address';
		}
		else if ($this->getLayout() == 'account')
		{
			$this->accountitems = $this->get('Items');
			$this->setLayout('account');
			//$layout = 'account';
		}
		else
		{
            //JFactory::getApplication()->enqueueMessage('Debug: TSJViewTSJs::display layout=default');
			$this->setLayout('default');
            $this->defaultitems = $this->get('Items');
            //JFactory::getApplication()->enqueueMessage('Debug: TSJViewTSJs::display $this->defaultitems='.$this->defaultitems);
				
		}
        
		TSJsHelper::addSubmenu('tsjs');
		// Set the toolbar
		$this->addToolBar();

		// Display the template
		if (version_compare(JPlatform::RELEASE, '12', '>='))
		{
			$this->sidebar = JHtmlSidebar::render();
		}
		
		parent::display($tpl);

		// Set the document
		//$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		$state	= $this->get('State');
		$user	= JFactory::getUser();
        
		//$canDo	= TSJsHelper::getActions('com_tsj', 'category', $state->get('filter.category_id'));
        if (version_compare(JPlatform::RELEASE, '12', '<')){
            $canDo	= TSJsHelper::getActions('com_tsj');
        }
        else{
            $categoryId	= $this->state->get('filter.category_id');
            $canDo	= JHelperContent::getActions('com_tsj');
        }
        
        //JFactory::getApplication()->enqueueMessage('Debug: TSJViewTSJs::addToolBar state='. $state. ' user='.$user);
		
		// Заголовок
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'));
		//JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TSJS'), 'generic.png');

		// Кнопки
		$toolbar = JToolBar::getInstance('toolbar');
		$toolbar->addButtonPath(JPATH_COMPONENT.DS.'buttons');
		
		if ($this->getLayout() == 'street')
		{
        	if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('street.add');
            }
			if ($canDo->get('core.edit'))			
			{
				JToolBarHelper::editList('street.edit');
			}
			if ($canDo->get('core.delete'))			
			{
				JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'street.remove');
			}
		}
		else if ($this->getLayout() == 'city')
		{
			if ($canDo->get('core.create')) {
				JToolBarHelper::addNew('city.add');
			}
            if ($canDo->get('core.edit')){
                JToolBarHelper::editList('city.edit');
            }
            if ($canDo->get('core.delete')){
                JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'city.remove');
            }
		}
		else if ($this->getLayout() == 'address')
		{
			if ($canDo->get('core.create')) {        
                JToolBarHelper::addNew('address.add');
            }
            if ($canDo->get('core.edit')){
                JToolBarHelper::editList('address.edit');
            }
            if ($canDo->get('core.delete')){
                JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'address.remove');
            }
		}
		else if ($this->getLayout() == 'account')
		{
        	if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('account.add');
            }
            if ($canDo->get('core.edit')){
                JToolBarHelper::editList('account.edit');
            }
            if ($canDo->get('core.delete')){
                JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'account.remove');
            }
		}
		else{
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
		
                    
                    $toolbar->loadButtonType('wImport', true);		

                    if (version_compare(JPlatform::RELEASE, '12', '<')){
                        $toolbar->appendButton('wImport', 'tsjs-wimport', 'COM_TSJ_CONFIG_WIMPORT', 'tsjs.wimport',false);
                    }
                    else{
                        $toolbar->appendButton('wImport', 'wimport', 'tsjs-wimport', 'COM_TSJ_CONFIG_WIMPORT', 'tsjs.wimport', false);		
                    }

                    $doc = JFactory::getDocument();
                    //$icon_48_import = " .icon-48-tsjs {background:url(components/com_tsj/images/header/icon-48-importer.png) no-repeat; }";
                    //$doc->addStyleDeclaration($icon_48_import);
                    $icon_32_import = " .icon-32-tsjs-import {background:url(components/com_tsj/images/importer.png) no-repeat; }";
                    $doc->addStyleDeclaration($icon_32_import);
                    
		}
		
		// Options button.
		if (JFactory::getUser()->authorise('core.admin', 'com_tsj'))
		{
			JToolBarHelper::preferences('com_tsj');
		}

		JToolBarHelper::help( 'Components_TSJ', true );		
		
		if (version_compare(JPlatform::RELEASE, '12', '>='))
		{		
			JHtmlSidebar::setAction('index.php?option=com_tsj&view=default');
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