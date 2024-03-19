<?php
// No direct access
defined('_JEXEC') or die;
JHtml::_('stylesheet', 'modules/mod_hrz_show_single_user/css/style.css');
?>

<img src="<?=$user->imageFile?>"/>
<span class="userFirstName"><?=$user->firstName?></span> <span class="userLastName"><?=$user->lastName?></span><br />
<span class="userDepartment"><?=$user->department?></span><br />
<span class="userRole"><?=$user->role?></span><br />
<?php
    if($params->get('show_mail')) {
        ?>
        <span class="userMail"><a href="<?=$user->contactAddress?>"><i class="fas fa-regular fa-envelope fa-xl"></i></a></span>
        <?php
    }
    if($params->get('show_phone')) {
        ?>
        <span class="userMail"><a href="tel://<?=$user->phone?>"><i class="fas fa-regular fa-phone fa-xl"></i></a></span>
        <?php
    }