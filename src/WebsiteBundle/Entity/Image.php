<?php

namespace WebsiteBundle\Entity;

use WebsiteBundle\Utils\Globals;

abstract class Image extends File
{
    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    public function getDirectory()
    {
        return Globals::getPublicDir();
    }

    public function getUploadDir()
    {
        return basename($this->getDirectory()).'/'.$this->getUploadFolder();
    }
}