<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ecommerce\EcommerceBundle\Form\MediaType;

class CategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required' => true,
                'label'  => 'Nom du produit',
                'attr'=> array('class'=>'input is-9',
                    'placeholder'=>'Nom du produit'),
                'label_attr'=> array('class'=>'label is-3')
            ))
            ->add('image', MediaType::class, array(
                'data_class' => 'Ecommerce\EcommerceBundle\Entity\Media',
                'label'  => 'Image du produit',
                'attr'=> array('class'=>'is-9'),
                'label_attr'=> array('class'=>'label is-3')
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Categories'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_categories';
    }


}
