<?php
class ModHrzShowSingleUserHelper {

    public static function varDump($var)
    {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
		return;
    }
	
	public static function translateUserDetails(&$user, $userDetails) {

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
					default:
						break;
				}
			}
		}
	}

}
