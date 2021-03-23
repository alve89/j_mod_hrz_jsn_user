	<?php

	// No direct access
	defined('_JEXEC') or die;

	// Include the syndicate functions only once
	require_once dirname(__FILE__) . '/helper.php';
	require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');


	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $params->get('content'), '', 'mod_hrz_jsn_user.content');


	$user=new JsnUser($params->get('userid'));


	// Render output
	require JModuleHelper::getLayoutPath('mod_hrz_jsn_user');
