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
class JFormFieldAddress extends JFormFieldList
{
   /**
    * The field type.
    *
    * @var		string
    */
   protected $type = 'address';

   /**
    * Method to get a list of options for a list input.
    *
    * @return	array		An array of JHtml options.
    */
   protected function getOptions()
   {
      /*select *
      from #__tsj_address
      inner join #__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id
      inner join #__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id;*/
      
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      $query->select('*');
      $query->from('#__tsj_address');
      $query->innerJoin('#__tsj_city on #__tsj_address.city_id = #__tsj_city.city_id');
      $query->innerJoin('#__tsj_street on #__tsj_address.street_id = #__tsj_street.street_id');
      $db->setQuery((string)$query);
      $messages = $db->loadObjectList();
      
      $options = array();
      if ($messages)
      {
         foreach($messages as $message)
         {
            $options[] = JHtml::_('select.option',
               $message->address_id,
               $message->city . ', ' . $message->street .
               ', д.'. $message->house . ', кв.' . $message->office);
         }
      }
      $options = array_merge(parent::getOptions(), $options);
      return $options;
   }
}