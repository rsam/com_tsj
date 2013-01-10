<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * TSJ Table class
 */
class TSJTableCity extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $city_id = null;

    /**
     * @var string
     */
    var $city = null;
      
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__tsj_city', 'city_id', $db);
	}
}