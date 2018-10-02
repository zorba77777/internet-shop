<?php
namespace app\services;


use app\models\repositories\UserRep;
use app\models\repositories\SessionsRep;
use app\models\User;

class Auth
{
    protected $sessionKey = 'sid';

    public function login($login, $pass)
    {
        if(!$user = (new UserRep())->getByLoginPass($login, $pass)){
            return false;
        }
        $this->openSession($user);
        return true;
    }

    public function getSessionId()
    {
        $sid = $_SESSION[$this->sessionKey];
        if(!is_null($sid)){
            (new SessionsRep())->updateLastTime($sid);
        }
        return $sid;
    }

    public function openSession(User $user)
    {
        $sid = $this->generateStr();
        (new SessionsRep())->createNew($user->id, $sid, date("Y-m-d H:i:s"));
        $_SESSION[$this->sessionKey] = $sid;
    }

    private function generateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }
}