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
class JFormFieldLic extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var     string
	 */
	protected $type = 'lic';

	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__tsj_account');
		$query->order('#__tsj_account.account_id');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();

		if ($messages)
		{
			foreach($messages as $message)
			{
				$options[] = JHtml::_('select.option',
				$message->lic);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}

	/*public function getInput() {
	 return '<select id="'.$this->id.'" name="'.$this->name.'">'.
	 '<option value="0">no</option>'.
	 '<option value="1">yes</option>'.
	 '</select>';

	 parent::getInput();
	 }*/
}