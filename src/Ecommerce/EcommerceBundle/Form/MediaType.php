<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('file', FileType::class, array('data_class' => null), array('required' => true,
            'label'  => 'Image du produit',
            'attr'=> array('class'=>'input is-9'),
            'label_attr'=> array('class'=>'label is-3')
        ))
        ->add('name', TextType::class, array('required' => true,
            'label'  => 'Nom de l\'image',
            'attr'=> array('class'=>'input is-9'),
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
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Media'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_media';
    }
}
