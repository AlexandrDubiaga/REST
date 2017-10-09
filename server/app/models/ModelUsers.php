<?php
include ('../../app/RestServer.php');
class ModelUsers extends RestServer
{
    private $link;

    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
    }

    public function checkUsers()
    {
        if (isset($_COOKIE['id']) && isset($_COOKIE['hash']))
        {

            $id = $this->link->quote(($_COOKIE['id']));
            $sql = "SELECT user_login, user_hash FROM users WHERE user_id=".$id;
            $sth = $this->link->prepare($sql);
            $result = $sth->execute();
            if (false === $result)
            {
               return false;
            }
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            if ($data[0]['user_hash'] === $_COOKIE['hash'])
            {
                echo "Hello: ".$data[0]['user_login'];
                return true;
            }
            else
            {
                setcookie("id", "0", time()-3600*24*30*12, '/');
                setcookie("hash", "0", time()-3600*24*30*12, '/');
                return false;
            }
        }
        else
        {
            echo 'Login please';
            return false;
        }
    }
    public function loginUser($url,$param)
    {
        $pass = md5(md5(trim($param['pass'])));
        $login = $this->link->quote($param['login']);
        $sql = "SELECT user_id, user_password FROM users WHERE user_login=".$login;
        $sth = $this->link->prepare($sql);
        $result = $sth->execute();
        if (false === $result)
        {
           return false;
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data))
        {
            return false;
        }
        if (is_array($data))
        {
            foreach ($data as $val)
            {
                if ($pass !== $val['user_password'])
                {
                    return false;
                }
                else
                {
                    $id = $this->link->quote($val['user_id']);
                }
            }
        }

        $hash = $this->link->quote(md5($this->generateHash(10)));
        $sql = "UPDATE users SET user_hash=".$hash." WHERE user_id=".$id;
        $count = $this->link->exec($sql);

        if ($count === false)
        {
            return false;
        }
        $id = trim($id, "'");
        $hash = trim($hash, "'");
        setcookie("id", $id, time()+60*60*24*30, '/');
        setcookie("hash", $hash, time()+60*60*24*30, '/');

        return true;
    }

    public function logoutUser()
    {
        if (isset($_COOKIE['id']) && isset($_COOKIE['hash']))
        {
            setcookie("id", "0", time()-3600*24*30*12, '/');
            setcookie("hash", "0", time()-3600*24*30*12, '/');
            return true;
        }
        return false;
    }

    public function addUser($url,$param)
    {

        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
        {
           return false;
        }
        if(strlen($_POST['login']) < 3 || strlen($_POST['login']) > 30)
        {
            return false;
        }
        $login = $this->link->quote($param['login']);
        $pass = md5(md5(trim($_POST['pass'])));
        $pass = $this->link->quote($pass);
        $hash = $this->link->quote('hash');
        $sql = "INSERT INTO users (user_login, user_password, user_hash) VALUES (".$login.", ".$pass.", ".$hash.")";
        $count = $this->link->exec($sql);
        if ($count === false)
        {
            return false;
        }
        return $count;
    }

    function generateHash($length=6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
}
