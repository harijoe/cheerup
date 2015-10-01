<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use UserBundle\Entity\User;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add('profileType',
            'choice', [
                'label'   => 'register.field.profile_type',
                'choices' => User::getProfileTypesChoices()
            ])
            ->add('firstname', null, [
                'label' => 'register.field.firstname'
            ])
            ->add('lastname', null, [
                'label' => 'register.field.lastname'
            ])
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
