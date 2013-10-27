<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * TSJ Table class
 */
class TSJTableAddress extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $address_id = null;

	/**
	 * @var string
	 */
	var $city_id = null;

	/**
	 * @var string
	 */
	var $street_id = null;

	/**
	 * @var string
	 */
	var $house = null;

	/**
	 * @var string
	 */
	var $office = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__tsj_address', 'address_id', $db);
	}
}