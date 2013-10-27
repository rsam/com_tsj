<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * TSJ Form Field class for the TSJ component
 */
class JFormFieldElectros extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Electros';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		$options = array();

		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}