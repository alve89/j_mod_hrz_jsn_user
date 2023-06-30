<?php
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
$document = Factory::getDocument();
$document->addStyleSheet(JURI::base().'modules/'.$module->module . '/css/style.css');

?>


<div class="jsn_user_profile_wrapper">
	<div class="jsn_user_profile_avatar jsn_user_profile">
		<img src="<?=$user->getValue('avatar');?>" />
	</div>
	<div class="jsn_user_profile_name jsn_user_profile">
		<h4><?=$user->getValue('firstname') . ' ' . $user->getValue('lastname');?></h4>
	</div>
	<!-- <div class="jsn_user_profile_bereich jsn_user_profile">
		<?=$user->area?>
	</div> -->
	<div class="jsn_user_profile_abteilung jsn_user_profile">
		<?=$user->department;?>
	</div>
	<div class="jsn_user_profile_position jsn_user_profile">
		<?=$user->role;?>
	</div>
	<div class="jsn_user_profile_contact jsn_user_profile">
		<div class="jsn_user_profile_contact_icon">
			<?php
			if($params->get('show_mail')) {?>
				<div class="jsn_user_profile_contact_icon_mail_desktop">
					<form name="contactLink" action="<?=$params->get('defaultContactAddress');?>" method="post" target="_blank">
						<input type="hidden" name="<?=$params->get('parameterName');?>" value="<?=$user->getValue('convert_forms_contact_id');?>" />
						<input type="hidden" name="uid" value="<?=$user->getValue('id');?>" />
						<button type="submit" style="width: 40px; height: 40px; border-radius: 50%; background-color: white; border: 1px solid currentColor">
							<i class="fa fa-envelope"></i>
						</button>
					</form>
				</div>
				<div class="jsn_user_profile_contact_icon_mail_mobile">
					<form name="contactLink" action="<?=$params->get('defaultContactAddress');?>" method="post" target="_blank">
						<input type="hidden" name="<?=$params->get('parameterName');?>" value="<?=$user->getValue('convert_forms_contact_id');?>" />
						<input type="hidden" name="uid" value="<?=$user->getValue('id');?>" />
						<button type="submit" style="width: 40px; height: 40px; border-radius: 50%; background-color: white; border: 1px solid currentColor">
							<i class="fa fa-envelope"></i>
						</button>
					</form>
				</div>
			<?php }
				if($params->get('show_phone') && !empty($user->getValue('telefonnummer'))) {?>
					<a href="tel:<?=$user->getValue('telefonnummer');?>">
						<i class="fa fa-phone"></i>
					</a>
			<?php } ?>
		</div>

	</div>
</div>
