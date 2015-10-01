<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * @Config\Route("/profile", name="cheerup_profile")
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return;
    }
}
