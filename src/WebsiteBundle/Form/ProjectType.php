<?php

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProjectType extends AbstractType
{
    private $type;

    public function __construct($type = 'user')
    {
        $this->type = $type;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('position', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => false,
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
            ->add('title', TextType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.project_title')
            ))
            ->add('content', TextareaType::class, array(
                'translation_domain' => 'messages',
                'label' => false,
                'required' => true,
                'attr' => array('placeholder' => 'form.label.description')
            ))
            ->add('github', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'GitHub')
            ))
            ->add('repository', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'Repository')
            ))
            ->add('isActive', CheckboxType::class, array(
                'label'    => false,
                'required' => false
            ))
        ;

        if ($this->type == 'admin') {
            $builder ->add('github', TextType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array('placeholder' => 'GitHub *')
            ));

        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebsiteBundle\Entity\Project'
        ));
    }
}
