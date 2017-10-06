<?php
require_once('config.php');
class DB
{
    protected $dBMain;
    public function __construct()
    {
        $this->dBMain = mysqli_connect(HOST, USER, PASSWORD, DB);
        mysqli_set_charset( $this->dBMain,'utf8');
    }
}

?>