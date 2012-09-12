<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * TSJList Model
 */
class TSJModelPayments extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.		
/*		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('payment_id,payment_name');
		// From the hello table
		$query->from('#__tsj_payment');*/
        $query = 'payment';
		return $query;
	}
}