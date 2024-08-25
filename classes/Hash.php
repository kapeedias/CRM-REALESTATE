<?php
/* class Hash{
    public static function make($string, $salt = ''){
        return hash('sha256', $string . $salt);
    }
    public static function salt($length){
        return bin2hex(random_bytes($length));
        //return mcrypt_create_iv($length);
    }
    public static function unique(){
        return self::make(uniqid());
    }
}
*/


class Hash {
    public static function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    public static function salt($length) {
        // Use random_bytes to generate a cryptographically secure salt
        return bin2hex(random_bytes($length));    
    }

    public static function unique() {
        // Generate a more secure unique identifier
        //return bin2hex(random_bytes(16));  // 16 bytes = 32 characters in hexadecimal
        return self::make(uniqid());
    }

    public static function generatepassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifypassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

}
