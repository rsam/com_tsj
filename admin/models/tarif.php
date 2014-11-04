<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
jimport( 'joomla.application.component.view' );

/**
 * TSJ Model
 */
class TSJModelTarif extends JModelAdmin
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access    public
	 * @return    void
	 */
	function __construct()
	{
		parent::__construct();
			
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the id identifier
	 *
	 * @access    public
	 * @param    int id identifier
	 * @return    void
	 */
	function setId($id)
	{
		// Устанавливаем id и удаляем данные
		$this->_id        = $id;
		$this->_data    = null;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
	function delete(& $cids)
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$row = $this->getTable();

		foreach($cids as $cid) {
			if (!$row->delete( $cid )) {
				$this->setError( $row->getError() );
				return false;
			}
		}
			
		return true;
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	2.5
	 */
	public function getTable($type = 'Tarif', $prefix = 'TSJTable', $config = array())
	{
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
		$form = $this->loadForm('com_tsj.tarif', 'tarif',
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
		return 'administrator/components/com_tsj/models/forms/tarif.js';
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
		$data = JFactory::getApplication()->getUserState('com_tsj.edit.tarif.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}
}