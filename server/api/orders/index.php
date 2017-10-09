<?php
include('../../app/models/ModelOrders.php');
class Orders extends RestServer
{
    private $model;
    public function __construct()
    {
        $this->model = new ModelOrders();
        $this->run();
    }

    public function getOrders($data)
    {
        $result = $this->model->getOrders($data);
        $result = $this->encodedData($result);
        return $result;
    }
    public function postOrders($data)
    {
        $result = $this->model->addOrder($data);
        return $result;
    }
    public function putOrders($data)
    {
        $result = $this->model->changeStatus($data);
        return $result;
    }

    public function deleteOrders($data)
    {

    }
}
$cars = new Orders();
