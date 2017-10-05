<?php
class RestServer
{
    protected $reqMethod;
    protected $url;
    protected $param;
  

    public function run()
    {
      $this->url = list($s, $user, $REST, $server, $api, $dir, $index, $class, $data) = explode("/", $_SERVER['REQUEST_URI'], 7);
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        var_dump( $class);

        switch ($this->reqMethod)
        {
                case 'GET':
                $this->setMethod('get'.ucfirst($dir), explode('/', $index));
                break;
                case 'DELETE':
                $this->params = explode('/', $index);
                $this->setMethod('delete'.ucfirst($dir));
                break;
                case 'POST':
                $this->setMethod('post'.ucfirst($dir), explode('/', $index));
                break;
                case 'PUT':
                $putV = (explode('&', file_get_contents("php://input")));
                $put = array();
                foreach ($putV as $value)
                {
                    $keyValue = explode('=', $value);
                    $put[$keyValue[0]]=$keyValue[1];
                }
                $this->setMethod('put'.ucfirst($dir), explode('/', $index), $put);
                break;
        }
        
        
    }

    public function setMethod($classMethod, $param=false, $outPutt = false)
    {
                var_dump($this->$classMethod($param,$outPutt));
      
    }
     protected function encodedData($data)
    {
        switch ($this->encode)
        {
            case '.json':
                return json_encode($data);
                break;
            case '.txt':
                return 'TXT';
                break;
            case '.html':
                return 'HTML';
                break;
            case '.xml':
                return 'XML';
                break;
            default:
                return json_encode($data);
        }
    }
}
