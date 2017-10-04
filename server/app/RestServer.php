<?php
class RestServer
{
    protected $reqMethod;
    protected $url;

    public function run()
    {
      $this->url = list($s, $user, $REST, $server, $api, $dir, $index, $class, $data) = explode("/", $_SERVER['REQUEST_URI'], 7);
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];

        switch ($this->reqMethod)
        {
            case 'GET':
                $this->setMethod('get'.ucfirst($dir), explode('/', $index));
                break;
                case 'POST':
                $this->setMethod('post'.ucfirst($dir), explode('/', $index));
                break;
                case 'DELETE':
                $this->setMethod('delete'.ucfirst($dir), explode('/', $index));
                break;
        }
        
        
    }

    public function setMethod($classMethod, $param=false)
    {
        if(method_exists($this, $classMethod))
        {
            var_dump($this->$classMethod($param));
        }
        else
        {
            echo 'ERROR!';
        }
    }
}
