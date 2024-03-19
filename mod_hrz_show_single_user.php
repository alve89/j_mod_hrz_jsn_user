<?php

// No direct access
defined('_JEXEC') or die;



// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

/* TODO Replace specifying user by specifying department
* This prevents being forced to update all modules when persons change
*/

$user = new StdClass();


// Load custom fields for the given user (specified by 'userid' in modules configuration)
// a = fields
// b = fields_values
$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query->select(array('a.name', 'b.value'));
$query->from($db->quoteName('#__fields', 'a'));
$query->join('INNER', $db->quoteName('#__fields_values', 'b') . ' ON ' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.field_id'));	
$query->where($db->quoteName('b.item_id') . '='. $db->quote($params->get('userid')));
$db->setQuery((string) $query);
$userDetails = $db->loadObjectList();


if(!is_null($userDetails)) {
	
	foreach($userDetails as $detail) {
		switch($detail->name) {		
			case 'profile-photo':
				$user->imageFile = json_decode($detail->value)->imagefile;
				if(substr($user->imageFile,0,1) != '/') {
					$user->imageFile = '/' . $user->imageFile;
				}
				break;
			case 'first-name':
				$user->firstName = $detail->value;
				break;
			case 'last-name':
				$user->lastName = $detail->value;
			case 'convert-forms-contact-form-id':
				$user->cfid = $detail->value;
			case 'department':
				$user->department = $detail->value;
			case 'function':
				$user->role = $detail->value;
			case 'phone-number':
				$user->phone = $detail->value;
				break;
		}
	}

	$user->uid = $params->get('userid');

	}
	if($params->get('useSpecialInfomation')) {
		$user->department = $params->get('department');
		$user->role = $params->get('role');
	}


	if(!empty($params->get('defaultContactAddress')) && !empty($user->cfid) && !empty($params->get('parameterName'))) {
		// Kontaktseite IST definiert
		
	}
	else {
	// Kontaktseite ist NICHT definiert
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('default_value', 'id')));
		$query->from($db->quoteName('#__fields'));
	//	$query->join('INNER', $db->quoteName('#__fields_values', 'b') . ' ON ' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.field_id'));
		$query->where($db->quoteName('#__fields.name') . '='. $db->quote('convert-forms-contact-form-id'));
		$db->setQuery((string) $query);
		$result = $db->loadObjectList();

		$user->cfid = $result->default_value;

	}


	$user->contactAddress = trim(JUri::base() . ltrim($params->get('defaultContactAddress'), '/') . '?' . $params->get('parameterName') . '=' . $user->cfid . '&uid=' . $user->uid);
	$user->phone = ltrim($user->phone,'.');

	// Render output
	require JModuleHelper::getLayoutPath('mod_hrz_show_single_user');

	?>
	
