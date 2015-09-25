<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Config\Route("/", name="homepage")
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return;
    }
}
