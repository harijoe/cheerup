<?php

namespace UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add(
                'profileType',
                ChoiceType::class, [
                    'label'   => 'register.field.profile_type',
                    'choices' => User::getProfileTypesChoices(),
                ])
            ->add(
                'offshootOfOrigin',
                EntityType::class, [
                    'class'         => 'AppBundle\Entity\Group',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->where('a.offshoot = true');
                    },
                    'label'         => 'register.field.offshootOfOrigin',
                    'choice_label'  => 'name',
                ])
            ->add(
                'firstname',
                null, [
                    'label' => 'register.field.firstname'
                ])
            ->add(
                'lastname',
                null, [
                    'label' => 'register.field.lastname'
                ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
        ));
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
