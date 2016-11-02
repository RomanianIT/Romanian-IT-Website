<?php

namespace WebsiteBundle\Twig;

use WebsiteBundle\Helper\FileHelper;

class FileExtension extends \Twig_Extension
{
    /**
     * @param FileHelper $fileHelper
     * @param string     $uploadDir
     */
    public function __construct(FileHelper $fileHelper, $uploadDir)
    {
        $this->fileHelper = $fileHelper;
        $this->uploadDir  = $uploadDir;
    }

    /**
     * Returns a list of tests.
     *
     * @return array
     */
    public function getFunctions()
    {
        $functions = array(
            //@todo mettre au point ces méthodes pour checker l'existance de n'importe quel fichier (ged, document etc...)
            new \Twig_SimpleFunction(
                'fileExists',
                function ($filename) {
                    return file_exists($this->uploadDir.$filename);
                }
            ),
            new \Twig_SimpleFunction(
                'filePath',
                function ($filename) {
                    return $this->uploadDir.$filename;
                }
            ),
            new \Twig_SimpleFunction(
                'randomBackground',
                function () {
                    return $this->fileHelper->getRandomBackground();
                }
            )
        );

        return $functions;
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'File';
    }
}
