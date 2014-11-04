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
class TSJViewTarifs extends JViewAbstract
{
	protected $items;
	protected $pagination;
	protected $state;
    public $dbuser;

	/**
	 * Tarifs view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->form = $this->get('Form');
		$this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');
		$this->param = $this->get('Params');  
        $this->items = $this->get('Items');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// Set the toolbar
		$this->addToolBar();

		// Display the template
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
        }
        else{
            $categoryId	= $this->state->get('filter.category_id');
        }
        
		JToolBarHelper::title(JText::_('COM_TSJ_MANAGER_TARIF'));

		//Выводим кнопку настройки
		/*if (JFactory::getUser()->authorise('core.admin', 'com_tsj')) {
		JToolBarHelper::preferences('com_tsj');
		JToolBarHelper::divider();
		}*/
		$toolbar = JToolBar::getInstance('toolbar');
		$toolbar->addButtonPath(JPATH_COMPONENT.DS.'buttons');
     
		JToolBarHelper::addNew('tarif.add');
        JToolBarHelper::editList('tarif.edit');
		JToolBarHelper::deleteList('Вы действительно хотите удалить выбранные записи ?', 'tarif.remove');

		JToolBarHelper::help( 'com_tsj', true );
        
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