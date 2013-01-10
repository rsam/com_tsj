<?php
// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * TSJ Form Field class for the TSJ component
 */
class JFormFieldAccountCity extends JFormFieldList
{
   /**
    * The field type.
    *
    * @var		string
    */
   protected $type = 'accountcity';

   /**
    * Method to get a list of options for a list input.
    *
    * @return	array		An array of JHtml options.
    */
   protected function getOptions()
   {
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      $query->select('*');
      $query->from('#__tsj_account');
      $query->innerJoin('#__tsj_address on #__tsj_address.address_id = #__tsj_account.address_id');
      $query->innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id');
      $query->innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
      $query->innerJoin('#__users on #__tsj_account.user_id = #__users.id');
      $query->order('#__tsj_account.account_id');
      $db->setQuery((string)$query);
      $messages = $db->loadObjectList();
      $options = array();
      if ($messages)
      {
         foreach($messages as $message)
         {
            $options[] = JHtml::_('select.option',
            $message->city_id,
            $mesage->city);
         }
      }
      $options = array_merge(parent::getOptions(), $options);
      return $options;
   }
}