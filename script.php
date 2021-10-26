<?php
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Script file of mod_hrz_jsn_user module
 */
class mod_hrz_jsn_userInstallerScript
{
	/**
	 * Method to install the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function install($parent)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		$query->select($db->quoteName(array('extension_id', 'name', 'enabled')))
					->from($db->quoteName('#__extensions'))
					->where($db->quoteName('name') . ' = ' . $db->quote('plg_hrz_convertformsidchanger'));

		$db->setQuery($query);
		$db->query();
		$count = $db->getNumRows();

		if($count == 1) {
			// Plugin is installed
			$result = $db->loadObject();
			if(!$result->enabled) {
				JFactory::getApplication()->enqueueMessage('Make sure the <a href="/administrator/index.php?option=com_plugins&task=plugin.edit&extension_id='.$result->extension_id.'">plg_hrz_convertformsidchanger</a> plugin is enabled and set up correctly!', 'warning');
			}
		}
		else {
			JFactory::getApplication()->enqueueMessage('Plugin <a href="https://github.com/alve89/plg_hrz_convertformsidchanger">plg_hrz_convertformsidchanger</a> is not installed!', 'warning');
		}

	}

	/**
	 * Method to uninstall the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function uninstall($parent)
	{
	}

	/**
	 * Method to update the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function update($parent)
	{
		$this->install($parent);
	}

	/**
	 * Method to run before an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function preflight($type, $parent)
	{
	}

	/**
	 * Method to run after an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
	}
}
