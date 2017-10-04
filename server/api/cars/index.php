<?php
include '../../app/RestServer.php';
class Cars extends RestServer
{
    public function __construct()
    {
        $this->run();
    }

    public function getCars($data = false)
    {
         $link = mysqli_connect('localhost', 'user2', 'tuser2', 'user2');
        mysqli_set_charset($link,'utf8');
         $result = mysqli_query($link, "SELECT * FROM AutoShop");
        while ($row[] = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        }
        return $row;

       

    }
}
$cars = new Cars();
