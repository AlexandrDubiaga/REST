<?php
include '../../app/RestServer.php';
class Cars extends RestServer
{
    protected $link;
    public function __construct()
    {
        $this->link = mysqli_connect('localhost', 'user2', 'tuser2', 'user2');
        mysqli_set_charset($this->link,'utf8');
        $this->run();
        
    }

    public function getCars($data = false)
    {
         $result = mysqli_query($this->link, "SELECT * FROM AutoShop");
        while ($row[] = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        }
        return $row;

       

    }
     public function postCars()
    {
           $id = $_POST['id'];
           $marka = $_POST['marka'];
           $model = $_POST['model'];
           $year = $_POST['year_car'];
           $engine = $_POST['engine_capacity'];
           $color = $_POST['color'];
           $speed = $_POST['max_speed'];
           $price = $_POST['price'];
         if(isset($id) && isset($marka) && isset($model) && isset($year) && isset($engine) && isset($color) && isset($speed)  && isset($price))
         {
            $result = mysqli_query($this->link, "INSERT into AutoShop(id,marka,model,year_car,engine_capacity,color,max_speed,price) VALUES ('$id','$marka','$model','$year','$engine','$color','$speed','$price')");
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }  
         }
         return false;
    }
     public function deleteCar($data = false)
    {
            $SESSION['data'] =  $data[0];
        
            $result = mysqli_query($this->link, "DELETE from AutoShop where id = ' $SESSION['data']' ");
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }  
         return false;
    
       }
}
$cars = new Cars();
