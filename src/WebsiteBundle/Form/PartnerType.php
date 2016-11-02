<?php

namespace WebsiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar', ImageType::class, array(
                'required' => false,
                'label'      => 'Avatar',
                'data_class' => 'WebsiteBundle\Entity\Avatar'
            ))
            ->add('name', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.name')
            ))
            ->add('country', CountryType::class, array(
                'translation_domain' => 'messages',
                'data' => 'RO',
                'label' => false,
                'required' => true,
                'placeholder' => 'Țara *',
                'attr' => array('placeholder' => 'form.label.country')
            ))
            ->add('city', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.city')
            ))
            ->add('email', EmailType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.email')
            ))
            ->add('telephone', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'form.label.phone')
            ))
            ->add('website', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Website')
            ))
            ->add('facebook', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Facebook')
            ))
            ->add('linkedIn', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'LinkedIn')
            ))
            ->add('type', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Tip colaborare')
            ))
            ->add('description', TextareaType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'form.label.company_description')
            ))
            ->add('center', EntityType::class, array(
                'label' => false,
                'required' => true,
                'class'      => 'WebsiteBundle:Center',
                'expanded'   => false,
                'multiple'   => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebsiteBundle\Entity\Partner'
        ));
    }
}
