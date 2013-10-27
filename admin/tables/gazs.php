<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Water Table class
 */
class TSJTableGazs extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__tsj_gaz_data', 'gaz_id', $db);
	}
}

class TSJTableCounts extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__tsj_gaz_counter', 'office_counter_id', $db);
	}
}