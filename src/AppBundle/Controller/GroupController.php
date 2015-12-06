<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Group;
use AppBundle\Form\GroupFormType;

/**
 * Group controller.
 *
 * @Route("/group")
 */
class GroupController extends Controller
{
    /**
     * Finds and displays a Group entity.
     *
     * @Route("/{id}", name="cheerup_group_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Group $group)
    {
        return array(
            'group'      => $group,
        );
    }
}
