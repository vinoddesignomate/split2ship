<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Common; // Import library

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $common;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected $plane_details;
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->plane_details = array(
            "advanced" => array(
                "price" => 17.95,
                "validity" => 30,
                "order_sunc" => 200,
                "partial_product" => 2000
            ),
            "pro" => array(
                "price" => 30.95,
                "validity" => 30,
                "order_sunc" => 1000000,
                "partial_product" => 5000
            ),
            "ultimate" => array(
                "price" => 60.95,
                "validity" => 30,
                "order_sunc" => 1000000,
                "partial_product" => 10000
            )
        );
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->common = new Common();
        $this->session = \Config\Services::session(); 
        // E.g.: $this->session = \Config\Services::session();
    }
}
