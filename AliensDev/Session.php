<?php


namespace app;


class Session
{
    const AUTH_SESSION = 'auth_session';
    const FLASH_SESSION = 'flash_session';

    public function setAuthSession($arr) {
        $_SESSION['auth_session'] = $arr;
    }

    public function getAuthSession() {
        if(isset($_SESSION[self::AUTH_SESSION])) {
            return $_SESSION[self::AUTH_SESSION];
        }
        return null;
    }

    public function hasAuthSession() {
        if(isset($_SESSION[self::AUTH_SESSION])) {
            return true;
        }
        return false;
    }

    public function clearAuthSession()
    {
        unset($_SESSION[self::AUTH_SESSION]);
    }

    public function setFlashMessages($messages) {
        $_SESSION[self::FLASH_SESSION] = $messages;
    }
    public function getFlashMessages() {
        if($this->hasFlashMessages()){
            $messages = $_SESSION[self::FLASH_SESSION];
            unset($_SESSION[self::FLASH_SESSION]);
            return $messages;
        }
        return [];
    }

    public function hasFlashMessages() {
        return isset($_SESSION[self::FLASH_SESSION]);
    }
}