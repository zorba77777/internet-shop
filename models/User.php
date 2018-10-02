<?php
namespace app\models;

use app\models\repositories\SessionsRep;
use app\models\repositories\UserRep;
use app\services\Auth;

class User extends DataEntity
{
    public $id;
    public $login;
    public $password;

    /**
     * User constructor.
     * @param $id
     * @param $login
     * @param $password
     */
    public function __construct($id = null, $login = null, $password = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    public static function getTableName()
    {
        return 'users';
    }

    public function getCurrent()
    {
        if($userId = $this->getUserId()){
            return (new UserRep())->getById($userId);
        }
        return null;
    }

    public function getUserId()
    {
        $sid = (new Auth())->getSessionId();
        if(!is_null($sid)){
            return (new SessionsRep())->getUidBySid($sid);
        }
        return null;
    }
}