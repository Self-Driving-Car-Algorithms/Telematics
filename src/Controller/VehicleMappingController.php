<?php
namespace App\Controller;

use App\Functions\Geolocation;
use App\Functions\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VehicleMappingController extends AbstractController {

    private $dbconn;
    private $geolocation;
    private $auth;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
        $this->geolocation = new Geolocation();
        $this->auth = new Auth();
    }

    /**
    * Enable Vehicle Mapping
    *
    * @Route("/vehicles/{vehicle_id}/enable", name="enable_vehicle_mapping")
    */

    public function enable_vehicle_mapping(Request $request, $vehicle_id)
    {
        if($request->headers->has('Authorization')){
            if($this->auth->vehicle_login($request->headers->get('Authorization'), $vehicle_id)){
                $this->geolocation->enable_vehicle_mapping($vehicle_id);

                $response = new Response(json_encode([
                    'vehicles' => [
                        $vehicle_id => [
                            'mapping' => true
                        ]
                    ]
                ]));

                $response->headers->set('content-type', 'application/json');
                $response->setStatusCode(200);

                return $response;

            } else {
                $response = new Response(json_encode([
                    'error' => 'Invalid Auth'
                ]));
                $response->headers->set('content-type', 'application/json');
                $response->setStatusCode(401);

                return $response;

            }
        } else {
            $response = new Response(json_encode([
                'error' => 'Invalid Auth'
            ]));
            $response->headers->set('content-type', 'application/json');
            $response->setStatusCode(401);

            return $response;

        }
    }

    /**
    * Disable Vehicle Mapping
    *
    * @Route("/vehicles/{vehicle_id}/disable", name="disable_vehicle_mapping")
    */

    public function disable_vehicle_mapping(Request $request, $vehicle_id)
    {
        if($request->headers->has('Authorization')){
            if($this->auth->vehicle_login($request->headers->get('Authorization'), $vehicle_id)){
                $this->geolocation->disable_vehicle_mapping($vehicle_id);

                $response = new Response(json_encode([
                    'vehicles' => [
                        $vehicle_id => [
                            'mapping' => true
                        ]
                    ]
                ]));

                $response->headers->set('content-type', 'application/json');
                $response->setStatusCode(200);

                return $response;

            } else {
                $response = new Response(json_encode([
                    'error' => 'Invalid Auth'
                ]));
                $response->headers->set('content-type', 'application/json');
                $response->setStatusCode(401);

                return $response;

            }
        } else {
            $response = new Response(json_encode([
                'error' => 'Invalid Auth'
            ]));
            $response->headers->set('content-type', 'application/json');
            $response->setStatusCode(401);

            return $response;

        }
    }
}

