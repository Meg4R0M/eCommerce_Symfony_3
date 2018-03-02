<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class UtilisateursAdressesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('required' => true,
                                              'label'  => 'Nom',
                                              'attr'=> array('class'=>'input is-9',
                                                             'placeholder'=>'Votre Nom'),
                                              'label_attr'=> array('class'=>'label is-3')
                                             ))
            ->add('prenom',TextType::class,array('required' => true,
                                                 'label'  => 'Prenom',
                                                 'attr'=> array('class'=>'input is-9',
                                                                'placeholder'=>'Votre Prenom'),
                                                 'label_attr'=> array('class'=>'label is-3')
                                                ))
            ->add('telephone',NumberType::class,array('required' => true,
                                                      'label'  => 'Numéro de téléphone',
                                                      'attr'=> array('class'=>'input is-9',
                                                                     'placeholder'=>'0600000000'),
                                                      'label_attr'=> array('class'=>'label is-3')
                                                     ))
            ->add('adresse',TextType::class,array('required' => true,
                                                  'label'  => 'Adresse',
                                                  'attr'=> array('class'=>'input is-9',
                                                                 'placeholder'=>'Votre Adresse'),
                                                  'label_attr'=> array('class'=>'label is-3')
                                                 ))
            ->add('cp',NumberType::class,array('required' => true,
                                               'label'  => 'Code Postal',
                                               'attr'=> array('class'=>'input is-9',
                                                              'placeholder'=>'30100'),
                                               'label_attr'=> array('class'=>'label is-3')
                                              ))
            ->add('ville',TextType::class,array('required' => true,
                                                'label'  => 'Ville',
                                                'attr'=> array('class'=>'input is-9',
                                                               'placeholder'=>'Votre Ville'),
                                                'label_attr'=> array('class'=>'label is-3')
                                               ))
            ->add('pays',TextType::class,array('required' => true,
                                               'label'  => 'Pays',
                                               'attr'=> array('class'=>'input is-9',
                                                              'placeholder'=>'Votre Pays'),
                                               'label_attr'=> array('class'=>'label is-3')
                                              ))
            ->add('complement',TextType::class,array('required' => false,
                                                     'label'  => 'Complement',
                                                     'attr'=> array('class'=>'input is-9',
                                                                    'placeholder'=>'Complement d\'adresse'),
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
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_utilisateursadresses';
    }


}
