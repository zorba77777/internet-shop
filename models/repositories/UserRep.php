<?php


namespace app\models\repositories;


use app\models\User;

class UserRep extends Repository
{
    protected $nestedClass = User::class;

    /**
     * @return User
     */
    public function getByLoginPass($login, $pass)
    {
        $sql = "SELECT u.* FROM users u WHERE login = :login AND password = :pass";
        return $this->conn->fetchObject($sql,
            [
                ":login" => $login, ":pass" => md5($pass)
            ],
            $this->nestedClass
        );
    }

    /**
     * @return User
     */
    public function getById($id)
    {
        return $this->conn->fetchObject(
            "SELECT u.* FROM users u WHERE u.id = ?", [$id], $this->nestedClass
        );
    }
}