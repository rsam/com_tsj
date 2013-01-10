<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla formrule library
jimport('joomla.form.formrule');

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRulePhone extends JFormRule
{
   /**
    * The regular expression.
    *
    * @access  protected
    * @var     string
    * @since   2.5
    */
   protected $regex = '^[0-9()+\s]+$|^$';
}