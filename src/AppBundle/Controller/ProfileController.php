<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Picture;
use AppBundle\Entity\UserProfile;
use AppBundle\Form\Type\CheerupPositionCollectionFormType;
use AppBundle\Form\Type\CheerupPositionFormType;
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
 * @Route("/profile")
 **/
class ProfileController extends Controller
{
    /**
     * @Config\Route("/", name="cheerup_profile_index")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        $user = $this->getUser();

        return $this->redirectToRoute('cheerup_profile_show', ['id' => $user->getId()]);
    }

    /**
     * @param Request $request
     * @Config\Route("/edit", name="cheerup_profile_edit")
     * @Config\Template()
     *
     * @return array
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        /** @var UserProfile $userProfile */
        $userProfile           = $user->getUserProfile();
        $picture               = new Picture();

        $formUserProfile      = $this->createForm(UserProfileFormType::class, $userProfile);
        $formPicture          = $this->createForm(PictureFormType::class, $picture, ['validation_groups' => 'profile']);
        $formCheerupPositions = $this->createForm(CheerupPositionCollectionFormType::class, $userProfile);


        $formUserProfile->handleRequest($request);
        $formPicture->handleRequest($request);
        $formCheerupPositions->handleRequest($request);

        if ($formUserProfile->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($userProfile);
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.user_profile.success')
            );
        }
        if ($formPicture->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $userProfile->setPicture($picture);

            $em->persist($picture);
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.picture.success')
            );
        }
        if ($formCheerupPositions->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($userProfile); // Cheerup positions are cascade persisted
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.cheerup_positions.success')
            );
        }

        $userProfile->getCheerupPositions();

        return [
            'form_user_profile'        => $formUserProfile->createView(),
            'form_picture'             => $formPicture->createView(),
            'form_cheerup_positions'   => $formCheerupPositions->createView(),
            'user'                     => $user,
        ];
    }

    /**
     * @Config\Route("/danger-zone", name="cheerup_profile_danger_zone")
     * @Config\Template()
     * @Config\Security("has_role('ROLE_USER')")
     *
     * @return array
     */
    public function dangerZoneAction() {
        $user = $this->getUser();
        $formChangePassword = $this->container->get('fos_user.change_password.form');
        $formChangePasswordHandler = $this->container->get('fos_user.change_password.form.handler');

        $processChangePassword = $formChangePasswordHandler->process($user);

        if ($processChangePassword) {
            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.change_password.success')
            );
        }

        return [
            'form_change_password'     => $formChangePassword->createView(),
            'user'                     => $user,
        ];
    }

    /**
     * @param User $user
     *
     * @Config\Route("/{id}", name="cheerup_profile_show")
     * @Config\Template()
     *
     * @return array
     */
    public function showAction(User $user)
    {
        $currentUser = $this->getUser();
        $allowedToEdit = $currentUser->getId() === $user->getId();
        $userProfile = $user->getUserProfile();

        return [
            'allowed_to_edit' => $allowedToEdit,
            'user'   => $user,
        ];
    }
}
