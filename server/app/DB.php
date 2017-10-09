<?php
//inclube('config.php');
class DB
{
    protected $dBMain;
    public function __construct()
    {
        $this->dBMain = new PDO('mysql:host=10.3.149.74;dbname=work', 'bti', 'bti');
        if (!$this->dBMain)
        {
            throw new PDOException("Error db");
        }
    }
}

?>
