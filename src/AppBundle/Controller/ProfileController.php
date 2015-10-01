<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * @Config\Route("/profile", name="cheerup_profile_view")
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return;
    }

    /**
     * @Config\Route("/profile", name="cheerup_profile_edit")
     * @Config\Template()
     */
    public function editAction(Request $request)
    {
        // replace this example code with whatever you need
        return;
    }
}
