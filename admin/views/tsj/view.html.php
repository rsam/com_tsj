<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * TSJ View
 */
class TSJViewTSJ extends JViewAbstract
{
	/**
	 * display method of TSJ view
	 * @return void
	 */
	public function display($tpl = null)
	{
		// get the Data
		$this->form = $this->get('Form');
			
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');

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
        $input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title($isNew ? JText::_('COM_TSJ_MANAGER_TSJ_NEW') : JText::_('COM_TSJ_MANAGER_TSJ_EDIT'));
		JToolBarHelper::save('tsj.save');
		JToolBarHelper::cancel('tsj.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_TSJ_TSJ_CREATING') : JText::_('COM_TSJ_TSJ_EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_tsj" . "/views/tsj/submitbutton.js");
		JText::script('COM_TSJ_TSJ_ERROR_UNACCEPTABLE');
	}
}