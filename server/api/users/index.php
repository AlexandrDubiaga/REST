<?php
include '../../app/RestServer.php';
class Users extends RestServer
{
    protected $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
        $this->run();

    }

    protected function getUsers($data)
    {
        echo "Alex";
    }



    protected function postUsers()
    {
        $err = array();
        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['user_login']))
        {
            $err[] = "Login only letters";
        }
        if(strlen($_POST['user_login']) < 3 or strlen($_POST['user_login']) > 30)
        {
            $err[] = "login !< 3 and !> 30 letters";
        }
        $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_login='".mysql_real_escape_string( $_POST['user_login'])."'");
        if(mysql_result($query, 0) > 0)
        {
            $err[] = "This login is isset allredy";
        }
        if(count($err) == 0)
        {
            $login = $_POST['user_login'];
            $password = md5(md5(trim($_POST['user_password'])));
            mysqli_query($this->link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
            //header("Location: login.php"); exit();
        }
        else
        {
            print "<b>При регистрации произошли следующие ошибки:</b><br>";
            foreach($err AS $error)
            {
                print $error."<br>";
            }

        }

    }



}


$user = new Users();