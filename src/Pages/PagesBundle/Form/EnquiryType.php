<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EnquiryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('required' => true,
                                                 'label'  => 'Votre Nom',
                                                 'attr'=> array('class'=>'input is-9',
                                                                'placeholder'=>'Votre nom'),
                                                 'label_attr'=> array('class'=>'label is-3')
                                                ))
            ->add('email', EmailType::class, array('required' => true,
                                                   'label'  => 'Votre adresse mail',
                                                   'attr'=> array('class'=>'input is-9',
                                                                  'placeholder'=>'Votre adresse mail'),
                                                   'label_attr'=> array('class'=>'label is-3')
                                                  ))
            ->add('subject', TextType::class, array('required' => true,
                                                    'label'  => 'Sujet du message',
                                                    'attr'=> array('class'=>'input is-fullwidth',
                                                                   'placeholder'=>'Sujet du message'),
                                                    'label_attr'=> array('class'=>'label is-3')
                                                   ))
            ->add('body', TextareaType::class, array('required' => true,
                                                     'label'  => 'Votre Message',
                                                     'attr'=> array('class'=>'textarea is-9'),
                                                     'label_attr'=> array('class'=>'label is-3')
                                                    ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pages\PagesBundle\Entity\Enquiry'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pages_pagesbundle_contact';
    }

}
