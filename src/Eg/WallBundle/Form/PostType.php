<?php

namespace Eg\WallBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('content')
            //->add('categories')
            ->add('categories', 'entity', array(
                'class'         => 'Eg\WallBundle\Entity\Category',
                'expanded'      => true,
                'multiple'      => true,
                'required'      => false,
                'query_builder' => null,
                'by_reference'  => false,
                'constraints'   => array(
                    new Count(array(
                                  'min'        => 1,
                                  'minMessage' => 'Tu dois lier ton post à au moins 1 catégorie !',
                              )),
                ),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                                   'data_class' => 'Eg\WallBundle\Entity\Post'
                               ));
    }
}
