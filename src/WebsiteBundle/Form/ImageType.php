<?php

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                'label'      => $options['label'],
                'required'   => false,
                'file_path'  => 'webPath',
                'file_name'  => 'originalName',
                'clear_file' => true,
                'overview'   => true
            ))
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'image';
    }
}
