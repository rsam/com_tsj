<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla formrule library
jimport('joomla.form.formrule');

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleStreet extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	2.5
	 */
	//protected $regex = '^[A-zÐ-Ñ0-9_^\,./-\s]+$';
    
public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
    {
        if(!preg_match('/[A-z0-9À-ÿ_^\,\.\-]+/i', $value)) {
            $element->addAttribute('message', 'Field may only contain A-z À-ÿ 0-9 _^,.-');
            return false;
        }/*elseif(!$somethingelse) {
            $element->addAttribute('message', 'Something else is wrong');
            return false;
        }*/ 
    }  
}