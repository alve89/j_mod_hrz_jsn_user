<?php

// No direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
if(!is_file(JPATH_SITE.'/components/com_jsn/helpers/helper.php')) {
	JFactory::getApplication()->enqueueMessage('Component com_jsn not found', 'error');
	JLog::addLogger(
	    array(
	         // Sets file name
	         'text_file' => 'mod_hrz_jsn_user.log.php'
	    ),
	    // Sets messages of all log levels to be sent to the file.
	    JLog::ALL,
	    // The log category/categories which should be recorded in this file.
	    // We still need to put it inside an array.
	    array('mod_hrz_jsn_user')
	);
	JLog::add(JText::_('Component com_jsn not found'), JLog::ERROR, 'mod_hrz_jsn_user');
}
else {
	require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');

	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $params->get('content'), '', 'mod_hrz_jsn_user.content');


	$user=new JsnUser($params->get('userid'));

	// Render output
	require JModuleHelper::getLayoutPath('mod_hrz_jsn_user');

}
