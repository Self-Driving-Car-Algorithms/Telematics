<?php
namespace App\Functions;

class Geolocation {

    private $dbconn;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
    }

    /* Enable/Disable Visibility */

    public function enable_vehicle_mapping($vehicle_id)
    {
        $prepared_statement_name = $vehicle_id.'_enable_mapping';
        pg_prepare($this->dbconn, $prepared_statement_name, 'UPDATE vehicles SET mapping_enabled = true WHERE vehicle_id = $1');
        pg_execute($this->dbconn, $prepared_statement_name, array($vehicle_id));
    }

    public function disable_vehicle_mapping($vehicle_id)
    {
        $prepared_statement_name = $vehicle_id.'_disable_mapping';
        pg_prepare($this->dbconn, $prepared_statement_name, 'UPDATE vehicles SET mapping_enabled = false WHERE vehicle_id = $1');
        pg_execute($this->dbconn, $prepared_statement_name, array($vehicle_id));
    }

    /* Get & Update Geolocation */
    
    public function get_vehicle_geolocation($vehicle_id)
    {
        if($this->vehicles->isEnabled($vehicle_id)){
            $prepared_statement_name = $vehicle_id.'_get_geolocation';
            pg_prepare($this->dbconn, $prepared_statement_name, 'SELECT lat, long FROM vehicles WHERE vehicle_id = $1');
            $result = pg_fetch_array(pg_execute($this->dbconn, $prepared_statement_name, array($vehicle_id)));

            return [
                'vehicles' => [
                    $vehicle_id => [
                        'location' => [
                            'latitude' => $result['lat'],
                            'longtitude' => $result['long']
                        ]
                    ]
                ]
            ];
        } else {
            return [
                'vehicles' => [
                    $vehicle_id => [
                        'mapping' => 'disabled'
                    ]
                ]
            ];
        }
    }

    public function update_vehicle_geolocation($vehicle_id, $geolocation)
    {
        $geolocation = json_decode($geolocation, true);
        $prepared_statement_name = $vehicle_id.'_update_geolocation';

        pg_prepare($this->dbconn, $prepared_statement_name, 'UPDATE vehicles WHERE vehicle_id = $1 SET lat = $2, long = $3');
        pg_execute($this->dbconn, $prepared_statement_name, array($vehicle_id, $geolocation['latitude'], $geolocation['longtitude']));
    }
}
