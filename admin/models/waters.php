<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
//jimport('joomla.application.component.modellist');

// Include dependancy of the main model form
jimport( 'joomla.application.component.modeladmin' );
// import Joomla modelitem library
//jimport('joomla.application.component.modelitem');
// Include dependancy of the dispatcher
//jimport('joomla.event.dispatcher');

/**
 * TSJList Model
 */
class TSJModelWaters extends JModelAdmin
{
   /**
    * Get the data for a new qualification
    */
   public function getForm($data = array(), $loadData = true)
   {
      //$app = JFactory::getApplication('site');

      // Get the form.
      $form = $this->loadForm('com_tsj.waters', 'waters', array('control' => 'prefix_text', 'load_data' => true));
      if (empty($form)) {
         return false;
      }
      return $form;

   }
}