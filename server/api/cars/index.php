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
        echo json_encode($data);
        /* $result = mysqli_query($this->link, "SELECT * FROM AutoShop");
        while ($row[] = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        }
        return $row;*/

       

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
     public function deleteCars($url)
    {
            $id =  $this->params;
            //var_dump($id);
            $result = mysqli_query($this->link, "DELETE from AutoShop where id = '$id' ");
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
    public function putCars($url, $param)
    {
        $id = $param['id'];
      
        if(isset($param['id']) && isset($param['marka']) && isset($param['model']) && isset($param['year_car']) && isset($param['engine_capacity']) && isset($param['color']) && isset($param['max_speed'])  && isset($param['price'])) {
            $query = mysqli_query($this->link, "UPDATE AutoShop SET marka = '$param[marka]', model = '$param[model]', year_car = '$param[year_car]', engine_capacity = '$param[engine_capacity]', color = '$param[color]', max_speed = '$param[max_speed]', price = '$param[price]' WHERE id = '$id'");
            if ($query)
                return true;
            else
                return false;
        }
    }
}

       
$cars = new Cars();
