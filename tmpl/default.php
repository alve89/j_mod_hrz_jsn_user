
<?php 
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
$document = Factory::getDocument();
$document->addStyleSheet(JURI::base().'modules/'.$module->module . '/css/style.css');

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

	if(!empty($user->getValue('convert_forms_contact_id')) && !empty($params->get('parameterName'))) {
		$user->kontaktadresse = $params->get('defaultContactAddress') . '?' . $params->get('parameterName') . '=' . $user->getValue('convert_forms_contact_id');
	}
	else {
		$user->kontaktadresse = $params->get('defaultContactAddress');
	}
}

!empty(parse_url($user->kontaktadresse)['query']) ? $user->kontaktadresse .= '&' : $user->kontaktadresse .= '?';

$user->kontaktadresse .= 'uid='.$user->getValue('id');
	


?>


<div class="jsn_user_profile_wrapper">
	<div class="jsn_user_profile_avatar jsn_user_profile">
		<img src="/<?=$user->getValue('avatar');?>" />
	</div>
	<div class="jsn_user_profile_name jsn_user_profile">
		<h4><?=$user->getValue('firstname') . ' ' . $user->getValue('lastname');?></h4>
	</div>
	<div class="jsn_user_profile_bereich jsn_user_profile">
		<?=is_null($user->getValue('bereich')) ? '' : $user->getValue('bereich');?>
	</div>
	<div class="jsn_user_profile_abteilung jsn_user_profile">
		<?=is_null($user->getValue('abteilung')) ? '' : $user->getValue('abteilung');?>
	</div>
	<div class="jsn_user_profile_position jsn_user_profile">
		<?=$user->getValue('position');?>
	</div>
	<div class="jsn_user_profile_contact jsn_user_profile">
		<div class="jsn_user_profile_contact_icon">
			<div class="jsn_user_profile_contact_icon_mail_desktop">
				<a href="<?=$user->kontaktadresse;?>" target="_blank">
					<i class="fa fa-envelope"></i>
				</a>
			</div>
			<div class="jsn_user_profile_contact_icon_mail_mobile">
				<a href="<?=$user->kontaktadresse;?>" target="_blank">
					<i class="fa fa-envelope"></i>
				</a>

			</div>
			<?php
				if(!empty($user->getValue('telefonnummer'))) {?>
					<a href="tel:<?=$user->getValue('telefonnummer');?>">
						<i class="fa fa-phone"></i>
					</a>
			<?php } ?>
		</div>

	</div>
</div>