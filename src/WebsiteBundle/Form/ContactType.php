<?php

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => false
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'WebsiteBundle\Entity\Contact',
            'translation_domain' => 'contact'
        ));
    }

    public function getName() {
        return 'contacttype';
    }
}

