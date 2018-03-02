<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ecommerce\EcommerceBundle\Form\MediaType;

class ProduitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('required' => true,
                                                'label'  => 'Nom du produit',
                                                'attr'=> array('class'=>'input is-9',
                                                               'placeholder'=>'Nom du produit'),
                                                'label_attr'=> array('class'=>'label is-3')
                                                ))
            ->add('description', TextareaType::class, array('required' => true,
                                                            'label'  => 'Description du produit',
                                                            'attr'=> array('class'=>'ckeditor is-9',
                                                                           'placeholder'=>'Description du produit'),
                                                            'label_attr'=> array('class'=>'label is-3')
                                                            ))
            ->add('prix', NumberType::class, array('required' => true,
                                                   'label'  => 'Prix TTC du produit',
                                                   'attr'=> array('class'=>'input is-9',
                                                                  'placeholder'=>'12.34'),
                                                   'label_attr'=> array('class'=>'label is-3')
                                                  ))
            ->add('disponible', CheckboxType::class, array('label'  => 'Disponible',
                                                           'label_attr'=> array('class'=>'checkbox')
                                                          ))
            ->add('image', MediaType::class, array(
                'data_class' => 'Ecommerce\EcommerceBundle\Entity\Media',
                'label'  => 'Image du produit',
                'attr'=> array('class'=>'is-9'),
                'label_attr'=> array('class'=>'label is-3')
                ))
            ->add('categorie', null, array('label'  => 'Categorie du produit',
                                           'label_attr'=> array('class'=>'label is-3')
                                          ))
            ->add('tva', null, array('label'  => 'TVA du produit',
                                     'label_attr'=> array('class'=>'label is-3')
                                    ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Produits'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_produits';
    }


}
