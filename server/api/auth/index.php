include '../../app/RestServer.php';
class Auth extends RestServer
{
    protected $link;
    public function __construct()
    {
        parent::__construct();
        $this->link = $this->db;
        $this->run();
    }
    protected function getUsers($data)
    {
        echo "Auth;
    }
    protected function postAuth()
    {
      
    }
}
$auth = new Auth();
