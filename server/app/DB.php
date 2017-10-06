<?php
inclube('config.php');
class DB
{
    protected $dBMain;
    public function __construct()
    {
        $this->dBMain = mysqli_connect('localhost', 'user2', 'tuser2', 'user2');
        mysqli_set_charset( $this->dBMain,'utf8');
    }
}

?>
