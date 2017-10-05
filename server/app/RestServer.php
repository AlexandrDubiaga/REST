<?php
class RestServer
{
    protected $reqMethod;
    protected $url;
    protected $param;
    protected $encode;
  

    public function run()
    {
      $this->url = list($s, $user, $REST, $server, $api, $dir, $index, $class, $data) = explode("/", $_SERVER['REQUEST_URI'], 7);
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        $this->encode = $this->url[6];
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
                echo $this->$classMethod($param,$outPutt);
      
    }
     protected function encodedData($data)
    {
        switch ($this->encode)
        {
            case '.json':
               return  $this->convertToJson($data);
                break;
            case '.txt':
                return  $this->convertToTxt($data);
                break;
            case '.html':
                return  $this->convertToHtml($data);
                break;
            case '.xml':
                 return $this->convertToXml($data,'root');
                break;
            default:
                 return  $this->convertToJson($data);
        }
    }
    
    public function convertToJson($data)
    {
        header('Content-Type: application/json');
       echo json_encode($data);
    }
     public function convertToTxt($data)
    {
         header("Content-Type: text/javascript");
         print_r($data);
        
    }
     public function convertToHtml($data)
    {
            header("Content-type: text/html\n");
            $out = '<li>';
            foreach($data as $v){
                if(is_array($v)){
                    $out .= '<ul>'.recurseTree($v).'</ul>';
                }else{
                    $out .= $v;
            }
            }
           $out = '</li>';
         return '<ul>'.convertToHtml($data).'</ul>';
    }  
    
    public function convertToXml($data, $root)
    {
        header("Content-type: text/xml");
               $xml = new SimpleXMLElement( '<' . $root . '/>' );
  foreach( $data as $element=>$value ) {
    $element = is_numeric( $element ) ? $root : $element;
    if ( is_array( $value ) ) {
      if (is_numeric( $value ) ) {
        array2xml( $value, $xml, $element );
      } else {
        $element = $xml->addChild( $element );
        array2xml( $value, $$element, $element );
      }
    } else {
      $xml->addChild( $element, $value );
    }
   }
  return $xml->asXML();
          
    }
    
}

