<?php

namespace WebsiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isAmbasador', HiddenType::class, array(
                'translation_domain' => 'messages',
                'data' => 0
            ))
            ->add('avatar', ImageType::class, array(
                'required' => false,
                'label'      => 'Avatar',
                'data_class' => 'WebsiteBundle\Entity\Avatar'
            ))
            ->add('firstname', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.firstname')
            ))
            ->add('lastname', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.lastname')
            ))
            ->add('city', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.city')
            ))
            ->add('country', CountryType::class, array(
                'translation_domain' => 'messages',
                'data' => 'RO',
                'label' => false,
                'required' => true,
                'placeholder' => 'Țara *',
                'attr' => array('placeholder' => 'form.label.country')
            ))
            ->add('expertise', HiddenType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'form.label.expertise')
            ))
            ->add('position', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.position')
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
            ->add('twitter', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Twitter')
            ))
            ->add('behance', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Behance')
            ))
            ->add('git', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Git')
            ))
            ->add('website', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Website')
            ))
            ->add('reason', TextareaType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.reason')
            ))
            ->add('interests', TextType::class, array(
                'label' => false,
                'required' => false
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
            'data_class' => 'WebsiteBundle\Entity\Member'
        ));
    }
}
