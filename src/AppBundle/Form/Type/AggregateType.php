<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Aggregate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AggregateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label'   => 'admin.index.aggregate.create.field.name'
            ])
            ->add('description', null, [
                'label'   => 'admin.index.aggregate.create.field.description'
            ])
            ->add('aggregateType',
                'choice', [
                    'label'   => 'admin.index.aggregate.create.field.aggregateType',
                    'choices' => Aggregate::getAggregateTypesChoices()
                ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Aggregate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_aggregate';
    }
}
