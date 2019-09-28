<?php
namespace App\Controller;

use App\Functions\Geolocation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GeolocationController extends AbstractController {

    private $dbconn;

    public function __construct()
    {
    	$this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
    }

    /**
    * Get Vehicle Geolocation
    *
    * @Route("/vehicles/{vehicle_id}/geolocation", name="get_vehicle_geolocation", methods={"GET"})
    */

    public function get_vehicle_geolocation(Request $request, $vehicle_id)
    {
        
    }

    /**
    * Update Vehicle Geolocation
    *
    * @Route("/vehicles/{vehicle_id}/geolocation", name="update_vehicle_geolocation", methods={"POST"})
    */

    public function update_vehicle_geolocation(Request $request, $vehicle_id)
    {
        
    }
}