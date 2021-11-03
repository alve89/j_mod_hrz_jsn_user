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

	$id = $params->get('area');

	$user=new JsnUser($params->get('userid'));

	if($params->get('useSpecialInfomation')) {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('#__categories.title'));
		$query->from($db->quoteName('#__categories'));
		$query->where($db->quoteName('#__categories.id') . '=' . $db->quote($id));
		$db->setQuery((string) $query);
		$category = $db->loadResult();
		$user->area = $category;
		$user->department = $params->get('department');
		$user->role = $params->get('role');
	}
	else {
		$user->area = $user->get('bereich');
		$user->department = $user->get('abteilung');
		$user->role = $user->get('position');
	}

	if(!empty($user->getValue('kontaktseite'))) {
		// Kontaktseite IST definiert
		if(!empty($user->getValue('convert_forms_contact_id')) && !empty($params->get('parameterName'))) {
			$user->kontaktadresse = $user->getValue('kontaktseite') . '?' . $params->get('parameterName') . '=' . $user->getValue('convert_forms_contact_id');
		}
		else {

			$user->kontaktadresse = $user->getValue('kontaktseite');
		}
	}
	else {
		// Kontaktseite ist NICHT definiert
		if(!empty($user->getValue('convert_forms_contact_id')) && !empty($params->get('parameterName'))) {
			$user->kontaktadresse = $params->get('defaultContactAddress') . '?' . $params->get('parameterName') . '=' . $user->getValue('convert_forms_contact_id');
		}
		else {
			$user->kontaktadresse = $params->get('defaultContactAddress');
		}

		if(substr($user->getValue('avatar'),0,1) != '/') {
			$user->avatar = '/'.$user->getValue('avatar');
		}

	}

	!empty(parse_url($user->kontaktadresse)['query']) ? $user->kontaktadresse .= '&' : $user->kontaktadresse .= '?';
	$user->kontaktadresse .= 'uid='.$user->getValue('id');




	// Render output
	require JModuleHelper::getLayoutPath('mod_hrz_jsn_user');

}
