<?php
include ('../../app/RestServer.php');
class ModelCars extends RestServer
{
    private $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
    }
    public function getCars($param=false)
    {
        $sql = "SELECT car_id, marka, model, year_car, 	engine_capacity, color, max_speed, price FROM cars";
        /*if ($param !== false){
            if (is_array($param))
            {
                $sql .= " WHERE ";
                foreach ($param as $key => $val)
                {
                    $sql .= $key.'='.$this->link->quote($val).' AND ';
                }
                $sql = substr($sql, 0, -5);
               }
        }*/
        $sth = $this->link->prepare($sql);
        $result = $sth->execute();
        /*if ($result === false)
        {
            $x = "SELECT car_id, marka, model, year_car, engine_capacity, color, max_speed, price FROM cars";
            $sth = $this->link->prepare($x);
            $result = $sth->execute();
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data))
        {
           return false;
        }
      */
        return $result;
    }

    public function postCars($data)
    {
        $id = $this->link->quote($data['car_id']);
        $marka = $this->link->quote($data['marka']);
        $model = $this->link->quote($data['model']);
        $year = $this->link->quote($data['year_car']);
        $engine = $this->link->quote($data['engine_capacity']);
        $color = $this->link->quote($data['color']);
        $speed = $this->link->quote($data['max_speed']);
        $price = $this->link->quote($data['price']);
        if(isset($id) && isset($marka) && isset($model) && isset($year) && isset($engine) && isset($color) && isset($speed)  && isset($price))
        {
            $result = "INSERT into cars(car_id,marka,model,year_car,engine_capacity,color,max_speed,price) VALUES (".$id.",".$marka.",".$model.",".$year.",".$engine.",".$color.",".$speed.",".$price.")";
            $count = $this->link->exec($result);
            if($count)
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

    public function putsCars($url, $param)
    {
        $id = $this->link->quote($param['car_id']);
        $marka = $this->link->quote($param['marka']);
        $model = $this->link->quote($param['model']);
        $year = $this->link->quote($param['year_car']);
        $engine = $this->link->quote($param['engine_capacity']);
        $color = $this->link->quote($param['color']);
        $speed = $this->link->quote($param['max_speed']);
        $price = $this->link->quote($param['price']);
        if(isset($id) && isset($marka) && isset($model) && isset( $year) && isset(  $engine) && isset( $color ) && isset($speed)  && isset($price))
            {
                $query = "UPDATE cars SET marka = ".$marka.", model = ".$model.", year_car = ".$year.", engine_capacity = ".$engine.", color = ".$color.", max_speed = ".$speed.", price = ".$price." WHERE car_id = $id";
                $count = $this->link->exec($query);
                if ($count)
                {
                   return true;
                }
                else
                {
                    return false;
                }

            }
    }

    public function deleteCars($url)
    {
        $id = $url[0];
        $sql="DELETE FROM cars WHERE car_id=' $id '";
        $count = $this->link->exec($sql);
        if($count)
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
