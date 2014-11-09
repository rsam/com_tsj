<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * TSJ View
 */
class TSJViewTarif extends JViewAbstract
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;
	protected $isNew = null;
	protected $script = null;

	/**
	 * display method of TSJ view
	 * @return void
	 */
	public function display($tpl = null)
	{
		// get the Data
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');
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
		JRequest::setVar('hidemainmenu', true);      
		$isNew = ($this->item->tarif_id == 0);
		JToolBarHelper::title($this->isNew ? JText::_('COM_TSJ_NEW_RECORD') : JText::_('COM_TSJ_EDIT_RECORD'));
		JToolBarHelper::save('tarif.save');
		JToolBarHelper::cancel('tarif.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

		$this->assignRef('tarif', $this->item);        
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$isNew = ($this->item->tarif_id == 0);
		$document->setTitle($isNew ? JText::_('CREATING') : JText::_('EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_tsj/views/tarif/submitbutton.js");
		JText::script('COM_TSJ_TSJ_ERROR_UNACCEPTABLE');
	}
}