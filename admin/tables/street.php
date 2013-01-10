<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * TSJ Table class
 */
class TSJTableStreet extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $street_id = null;

    /**
     * @var string
     */
    var $street = null;
    
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__tsj_street', 'street_id', $db);
	}
}