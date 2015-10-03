<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProfilePicture;
use AppBundle\Entity\UserProfile;
use AppBundle\Form\Type\ProfilePictureFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use AppBundle\Form\Type\UserProfileFormType;

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
        /** @var UserProfile $userProfile */
        $userProfile = $user->getUserProfile();
        $currentProfilePictureWebPath = $userProfile->getProfilePicture()->getWebPath();
        $profilePicture = new ProfilePicture();

        $formUserProfile = $this->createForm(new UserProfileFormType(), $userProfile);
        $formProfilePicture = $this->createForm(new ProfilePictureFormType(), $profilePicture);

        $formUserProfile->handleRequest($request);
        $formProfilePicture->handleRequest($request);

        if ($request->isMethod('POST')){
            if ($formUserProfile->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($userProfile);
                $em->flush();

                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('profile.edit.user_profile.success')
                );

                return $this->redirectToRoute('cheerup_profile_edit');
            }
            if ($formProfilePicture->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $userProfile->setProfilePicture($profilePicture);

                $em->persist($profilePicture);
                $em->flush();

                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('profile.edit.profile_picture.success')
                );

                return $this->redirectToRoute('cheerup_profile_edit');
            }
        }

        return array(
            'current_profile_picture_web_path' => $currentProfilePictureWebPath,
            'form_user_profile' => $formUserProfile->createView(),
            'form_profile_picture' => $formProfilePicture->createView()
        );
    }
}
