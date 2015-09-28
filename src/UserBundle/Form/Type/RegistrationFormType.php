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
            ->add('firstName', null, [
                'label' => 'register.field.first_name'
            ])
            ->add('lastName', null, [
                'label' => 'register.field.last_name'
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
