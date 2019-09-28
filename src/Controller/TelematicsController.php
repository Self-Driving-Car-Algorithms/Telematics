<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TelematicsController extends AbstractController {

    private $dbconn;

    public function __construct()
    {
    	$this->dbconn = pg_connect("host=" . getenv('DB_HOST') . " port=5432 dbname=" . getenv('DB_NAME') . " user=" . getenv('DB_USERNAME') . " password=" . getenv('DB_PASSWORD'));
    }

    /**
    * Index page
    *
    * @Route("/", name="index")
    */

    public function index(Request $request)
    {
        $response = new Response(json_encode([
            'InstanceInfo' => [
                'SysInfo' => [
                    'Version' => 'InDev-000',
                ],
                'Contact' => getenv('CONTACT_EMAIL')
            ],
            'Documentation' => getenv('DOCS_LINK')
        ]));
        $response->headers->set('content-type', 'application/json');
        return $response;
    }
}