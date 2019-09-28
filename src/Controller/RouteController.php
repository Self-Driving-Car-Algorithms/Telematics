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
    * Get all routes
    *
    * @Route("/routes", name="get_routes", methods={"GET"})
    */

    public function get_routes(Request $request)
    {
        $result = pg_fetch_all(pg_query('SELECT route_id, route_name, route_name_eng, route_stops FROM routes WHERE active = true'));

        return $result;
    }

    /**
    * Get vehicles enrolled in route
    *
    * @Route("/routes/{route_id}/vehicles", name="get_vehicles_by_route_id", methods={"GET"})
    */

    public function get_vehicles_by_route_id(Request $request, $route_id)
    {
        
    }
}