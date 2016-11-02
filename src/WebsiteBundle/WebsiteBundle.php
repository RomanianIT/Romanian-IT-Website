<?php

namespace WebsiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use WebsiteBundle\Utils\Globals;

class WebsiteBundle extends Bundle
{
    public function boot()
    {
        Globals::setGedDir($this->container->getParameter('ged_dir'));
        Globals::setDocumentDir($this->container->getParameter('document_dir'));
        Globals::setPublicDir($this->container->getParameter('public_dir'));
    }
}
