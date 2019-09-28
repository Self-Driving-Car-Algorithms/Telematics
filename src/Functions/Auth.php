<?php
namespace App\Functions;

class Auth {

    private $dbconn;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
    }

    public function vehicle_login($auth_token, $vehicle_id)
    {
        $prepared_statement_name = $vehicle_id.'_vehicle_login';
        pg_prepare($this->dbconn, $prepared_statement_name, 'SELECT COUNT(*) FROM vehicle_tokens WHERE auth_token = $1 AND vehicle_id = $2');
        $result = pg_fetch_array(pg_execute($this->dbconn, $prepared_statement_name, array($auth_token, $vehicle_id)));

        if($result['count'] == 1){
            return true;
        } else {
            return false;
        }
    }
}
