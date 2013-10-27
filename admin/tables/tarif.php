<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * TSJ Table class
 */
class TSJTableTarif extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $tarif_id = null;

	/**
	 * @var string
	 */
	var $tarif_name_short = null;
	var $tarif_name = null;
	var $tarif = null;
	var $tarif_1 = null;
	var $tarif_2 = null;
	var $tarif_type = 1;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__tsj_tarif', 'tarif_id', $db);
	}

	function check() {

		if( !is_numeric( $this->tarif_1) ){
			$this->tarif_1 = NULL;
		}

		if( !is_numeric( $this->tarif_2) ){
			$this->tarif_2 = NULL;
		}
		return parent::check();
	}
	 
	function store($updateNulls = false)
	{
		return parent::store(true);
	}
}