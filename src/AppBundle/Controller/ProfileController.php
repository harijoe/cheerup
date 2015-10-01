<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class ProfileController extends Controller
{
    /**
     * @param User    $user
     *
     * @Config\Route("/profile/{id}", name="cheerup_profile_view")
     * @Config\Template()
     *
     * @return array
     */
    public function indexAction(User $user)
    {
        return array(
            'fullname' => $user->getFullName()
        );
    }

    /**
     * @param Request $request

     * @Config\Route("/profile", name="cheerup_profile_edit")
     * @Config\Template()
     * @Config\Security("has_role('ROLE_USER')")
     *
     * @return array
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $userProfile = $user->getUserProfile();

        //$form = $this->createForm(new UserProfileType, $userProfile);

        //$form->handleRequest($request);

        //if ($request->isMethod('POST') && $form->isValid()) {
        //    $em = $this->getDoctrine()->getManager();
        //
        //    $em->persist($userProfile);
        //    $em->flush();
        //
        //    return $this->redirectToRoute('cheerup_profile_edit');
        //}

        return array(
            //'form' => $form->createView()
        );
    }
}
