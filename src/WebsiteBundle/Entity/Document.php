<?php

namespace WebsiteBundle\Entity;

use WebsiteBundle\Utils\Globals;

/**
 * Document
 */
abstract class Document extends File
{
    public function getClassName()
    {
        $reflect = new \ReflectionClass($this);

        return $reflect->getShortName();
    }

    public function getDirectory()
    {
        return Globals::getDocumentDir();
    }
}
