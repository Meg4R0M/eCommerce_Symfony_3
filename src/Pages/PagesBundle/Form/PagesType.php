<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array('required' => true,
                'label'  => 'Titre de la page',
                'attr'=> array('class'=>'input is-9',
                    'placeholder'=>'Titre de la page'),
                'label_attr'=> array('class'=>'label is-3')
            ))
            ->add('contenu',TextareaType::class, array('required' => true,
                'label'  => 'Contenu',
                'attr'=> array('class'=>'ckeditor is-9'),
                'label_attr'=> array('class'=>'label is-3')
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pages\PagesBundle\Entity\Pages'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pages_pagesbundle_pages';
    }


}
