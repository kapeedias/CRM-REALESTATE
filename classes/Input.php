<?php
class Input{
    public static function exists($type = 'post'){
        switch($type){
            case 'post':
                    return (!empty($_POST)) ? true : false;
            break;
            case 'get':
                    return (!empty($_GET)) ?  true : false;
            break;
            default:
                return false;
            break;
        }
    }

    public static function get($item){
        if(isset($_POST[$item])){
            return htmlentities($_POST[$item], ENT_QUOTES, 'UTF-8');
        }else if(isset($_GET[$item])){
            return htmlentities($_GET[$item], ENT_QUOTES, 'UTF-8');
        }
        return '';
    }




}