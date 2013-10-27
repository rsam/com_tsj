<?php
// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
jimport('joomla.form.helper');
jimport('joomla.form.formfield');
JFormHelper::loadFieldClass('list');

/**
 * TSJ Form Field class for the TSJ component
 */
class JFormFieldHouse extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var     string
	 */
	protected $type = 'house';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array    An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('address_id,house');
		$query->from('#__tsj_address');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();
		$options = array();
		if ($messages)
		{
			foreach($messages as $message)
			{
				$options[] = JHtml::_('select.option',
				$message->house);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}