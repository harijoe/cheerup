<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Form\Type\GroupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Profile controller.
 *
 * @Route("/admin")
 **/
class AdminController extends Controller
{
    /**
     * @param Request $request
     *
     * @Config\Route("/", name="cheerup_admin_index")
     * @Config\Template()
     * @Config\Security("has_role('ROLE_ADMIN')")
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $group = new Group();
        $form = $this->createForm(new GroupType(), $group);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('admin.index.group.create.success')
            );
        }

        return array(
            'group' => $group,
            'form'   => $form->createView(),
        );
    }
}
