<?php

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('type', ChoiceType::class, array(
                'choices' => array('Meetup' => 'Meetup', 'Conferință' => 'Conference'),
                'choices_as_values' => true,
            ))
            ->add('link')
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ))
            ->add('content')
            ->add('center')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebsiteBundle\Entity\Event'
        ));
    }
}
