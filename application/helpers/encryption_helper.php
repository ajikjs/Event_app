<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


   /* function encrypt($value) {
		return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', '12', true), $value, MCRYPT_MODE_ECB)), '=/+', '-_-');
	}

	function decrypt($value) {
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, hash('sha256', '12', true), base64_decode(strtr($value, '-_-', '=/+')), MCRYPT_MODE_ECB));
	} */
	function encrypt($value) {
		return strtr(base64_encode($value), '=', '-');
	}

	function decrypt($value) {
		return  (base64_decode(strtr($value, '-', '=')));
	}
