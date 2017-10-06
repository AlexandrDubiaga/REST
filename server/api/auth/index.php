<?php
include '../../app/RestServer.php';
class Auth extends RestServer
{
    protected $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
        $this->run();
    }
    protected function getAuth($data)
    {
        echo "Auth";
    }
    protected function postAuth()
    {
    $query = mysqli_query( $this->link,"SELECT user_id, user_password FROM users WHERE user_login='".$_POST['user_login']."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if($data['user_password'] === /*md5(md5(*/$_POST['user_password']/*))*/)

    {
        # Генерируем случайное число и шифруем его

        $hash = md5($this->generateCode(10));
        mysqli_query($this->link,"UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
        //ader("Location: check.php"); exit();
    }
    else

    {

        print "Вы ввели неправильный логин/пароль";

    }
      
    }
    function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}

}
$auth = new Auth();
?>
