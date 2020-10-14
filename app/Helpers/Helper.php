<?php

namespace App\Helpers;

define('METHOD', "aes-128-cbc");
define('KEY', "51C9D6DF37741DF8");
define('KEY_SMART', "2327E7E13A9A254C");
define('IV', "H12H34H90HABHEFH");

class Helper
{
    //1: Encrypt - 0: Decrypt
    public static function cryptR($input, $func, $smart = 0)
    {
        if ($func) {

            $json = json_encode($input);
            $response = openssl_encrypt($json, METHOD, ($smart ? KEY_SMART : KEY), 0, IV);

            return base64_encode($response);
        } else {

            $enc = base64_decode($input);
            $request = openssl_decrypt($enc, METHOD, ($smart ? KEY_SMART : KEY), 0, IV);

            return json_decode($request);
        }
    }
}
