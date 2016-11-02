<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avatar
 *
 * @ORM\Table(name="avatars")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Avatar extends Image
{
    public function getUploadFolder()
    {
        return 'avatar';
    }


    public function __toString()
    {
        return 'avatar';
    }
}
