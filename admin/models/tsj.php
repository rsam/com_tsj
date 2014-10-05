<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
jimport( 'joomla.application.component.view' );

/**
 * TSJ Model
 */
class TSJModelTSJ extends JModelAdmin
{ 
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	2.5
	 */
	public function getTable($type = 'TSJ', $prefix = 'TSJTable', $config = array())
	{
		//echo 'tsj getTable ';
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	2.5
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		// Check for layout override
		//echo 'tsj getFormCity '. $this->type;
		$form = $this->loadForm('com_tsj.city', 'city',
		array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	public function getScript()
	{
		return 'administrator/components/com_tsj/models/forms/tsj.js';
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	2.5
	 */
	protected function loadFormData()
	{

		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_tsj.edit.city.data', array());
		//echo 'tsj loadFormData ';
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}
}