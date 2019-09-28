<?php
namespace App\Functions;

class Vehicles {

    private $dbconn;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
    }

    
}
