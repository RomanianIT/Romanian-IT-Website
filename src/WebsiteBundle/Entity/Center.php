<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Center
 *
 * @ORM\Table(name="centres")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\CenterRepository")
 */
class Center
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="center", indexBy="center", cascade={"all"})
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="center", indexBy="center", cascade={"all"})
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="center", indexBy="center", cascade={"all"})
     */
    private $projects;

    /**
     * @var \Zone
     *
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     * })
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {   
        $this->events = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getLabel()
    {
        return 'Centru';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param string $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param \Zone $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }


}

