<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CheerupPositionCollectionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cheerupPositions', CollectionType::class, [
            'entry_type'      => CheerupPositionFormType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'label'     => false,
            'by_reference' => false,
        ]);
    }

    public function getName()
    {
        return 'app_cheerup_position_collection';
    }
}
