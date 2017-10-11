<?php
include('../../app/models/ModelCars.php');
class Cars extends RestServer
{
    private $model;
    public function __construct()
    {
        $this->model = new ModelCars();
        $this->run();
    }

    public function getCars($data)
    {
        $result = $this->model->getCars($data);
        $result = $this->encodedData($result);
        return $result;
    }

    public function postCars($url,$data)
    {
        $result = $this->model->postCars($data);

    }

    public function putCars($url, $param)
    {
        $result = $this->model->putsCars($url, $param);

    }

    public function deleteCars($data)
    {
        $res = $this->model->deleteCars($data);
    }
}
$cars = new Cars();
