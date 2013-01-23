<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * TSJ Form Field class for the TSJ component
 */
class JFormFieldWaters extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Waters';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		/*$db = JFactory::getDBO();
		 $query = $db->getQuery(true);
		 $query->select('water_id,data_hot_1');
		 $query->from('#__tsj_water');
		 $db->setQuery((string)$query);
		 $messages = $db->loadObjectList();*/
		$options = array();
		/*if ($messages)
		 {
			foreach($messages as $message)
			{
			$options[] = JHtml::_('select.option', $message->water_id, $message->data_hot_1);
			}
			}*/
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}