<?php
include('../../app/models/ModelUsers.php');
class Users extends RestServer
{
    private $model;
    public function __construct()
    {
        $this->model = new ModelUsers();
        $this->run();
    }
    public function getUsers()
    {
        $result = $this->model->checkUsers();
        return $result;
    }
    public function postUsers($url,$data)
    {
        $result = $this->model->addUser($url,$data);
        return $result;
    }
    public function putUsers($url,$data)
    {
        $result = $this->model->loginUser($url,$data);
        return $result;
    }
    public function deleteUsers($url)
    {
        $result = $this->model->logoutUser($url);
        return $result;
    }
}
$cars = new Users();
