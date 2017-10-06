<?php
include '../../app/RestServer.php';
class Check extends RestServer
{
    protected $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
        $this->run();
    }
    protected function getCheck($data)
    {
          echo "Cockies";
    }
         /* var_dump($_COOKIE['id']);
       if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

      {   
         

    $query = mysql_query("SELECT *  FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

    $userdata = mysql_fetch_assoc($query);


    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))

    {

        setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

        print "Хм, что-то не получилось";

    }

    else

    {

        print "Привет, ".$userdata['user_login'].". Всё работает!";

    }

}

else

{

    print "Включите куки";

}*/
    
   
}

?>

