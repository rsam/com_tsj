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
class JFormFieldUsername extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var     string
	 */
	protected $type = 'username';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array    An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,username');
		$query->from('#__users');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();
		$options = array();
		if ($messages)
		{
			foreach($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->username);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}

	/*public function getInput() {
	 return '<select id="'.$this->id.'" name="'.$this->name.'">'.
	 '<option value="1" >New York</option>'.
	 '<option value="2" >Chicago</option>'.
	 '<option value="3" >San Francisco</option>'.
	 '</select>';
	 }*/

}