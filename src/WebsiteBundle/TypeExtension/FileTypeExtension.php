<?php

namespace WebsiteBundle\TypeExtension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FileTypeExtension
 */
class FileTypeExtension extends AbstractTypeExtension
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return FileType::class;
    }

    /**
     * Add the file_path and file_name options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('file_path', 'file_name'));
        $resolver->setDefaults(array(
            'clear_file' => false,
            'overview'   => false
        ));
    }

    /**
     * Pass the file url and name to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('file_path', $options)) {
            $parentData = $form->getParent()->getData();

            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $filePath = $accessor->getValue($parentData, $options['file_path']);
            } else {
                $filePath = null;
            }

            // set a "file_path" variable that will be available when rendering this field
            $view->vars['file_path'] = $filePath;
        }

        if (array_key_exists('file_name', $options)) {
            $parentData = $form->getParent()->getData();

            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $fileName = $accessor->getValue($parentData, $options['file_name']);
            } else {
                $fileName = null;
            }

            // set a "file_name" variable that will be available when rendering this field
            $view->vars['file_name'] = $fileName;
        }

        if (array_key_exists('clear_file', $options)) {
            // set a "clear_file" variable that will be available when rendering this field
            $view->vars['clear_file'] = $options['clear_file'];
        }

        if (array_key_exists('overview', $options)) {
            // set an "overview" variable that will be available when rendering this field
            $view->vars['overview'] = $options['overview'];
        }
    }
}