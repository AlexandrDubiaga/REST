<?php
include ('../../app/RestServer.php');
class ModelOrders extends RestServer
{
    private $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
    }

    public function getOrders($param)
    {
        if (empty($param[0]))
        {
            return false;
        }

        $id_user = $this->link->quote($param[0]);
        $sql = "SELECT cars.car_id, cars.marka, cars.model, cars.price, orders.status".
            " FROM orders, cars WHERE orders.id_car=cars.car_id AND orders.id_user=".$id_user;
        $sth = $this->link->prepare($sql);
        $result = $sth->execute();
        if (false === $result)
        {
           return false;
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data))
        {
            return false;
        }
        return $data;
    }
    /*
    public function addOrder($param)
    {
        if (empty($param))
        {
            return false;
        }
        $id_car = $this->link->quote($param['id_car']);
        $id_user = $this->link->quote($param['id_user']);
        $status = '\'sent\'';
        $sql = "INSERT INTO orders (id_car, id_user, status) VALUES (".$id_car.", ".$id_user.", ".$status.")";
        $count = $this->link->exec($sql);
        if ($count === false)
        {
            throw new PDOException(ERR_QUERY);
        }
        return $count;
    }

    public function changeStatus($param)
    {
        if (empty($param['id_car']) && empty($param['id_user']) && empty($param['status']))
        {
            return false;
        }
        if ($param['status'] !== 'sent' && $param['status'] !== 'received')
        {
            return false;
        }
        $id_car = $this->link->quote($param['id_car']);
        $id_user = $this->link->quote($param['id_user']);
        $status = $this->link->quote($param['status']);
        $sql = "UPDATE orders SET status=".$status." WHERE id_car=".$id_car." AND id_user=".$id_user;
        $count = $this->link->exec($sql);
        if ($count === false)
        {
            throw new PDOException(ERR_QUERY);
        }
        return true;
    }
    */

}