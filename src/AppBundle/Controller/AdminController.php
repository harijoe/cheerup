<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aggregate;
use AppBundle\Entity\Picture;
use AppBundle\Entity\UserProfile;
use AppBundle\Form\Type\AggregateType;
use AppBundle\Form\Type\PictureFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use AppBundle\Form\Type\UserProfileFormType;

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
        $aggregate = new Aggregate();
        $form = $this->createForm(new AggregateType(), $aggregate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aggregate);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('admin.index.aggregate.create.success')
            );
        }

        return array(
            'aggregate' => $aggregate,
            'form'   => $form->createView(),
        );
    }
}
