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
       var_dump($data);
        
        echo "<br>";
           echo "<br>";
           echo "<br>";
         $link = mysqli_connect('localhost', 'user2', 'tuser2', 'user2');
        mysqli_set_charset($link,'utf8');
         $result = mysqli_query($link, "SELECT * FROM AutoShop");
        while ($row[] = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        }
        return $row;

       

    }
     public function postCars($data = false)
    {
           $id = $_POST['id'];
           $marka = $_POST['marka'];
           $model = $_POST['model'];
           $year = $_POST['year_car'];
           $engine = $_POST['engine_capacity'];
           $speed = $_POST['max_speed'];
           $price = $_POST['price'];
           $link = mysqli_connect('localhost', 'user2', 'tuser2', 'user2');
           mysqli_set_charset($link,'utf8');
           $result = mysqli_query($link, "INSERT into AutoShop VALUES ('$id','$marka','$model','$year','$engine','$speed','$price')");
            if($result)
            {
                return true;
            }
         else
         {
            return false;
         }

       

    }
}
$cars = new Cars();
