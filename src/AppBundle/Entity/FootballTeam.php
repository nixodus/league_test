<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * footballTeam
 *
 * @ORM\Table(name="football_team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\footballTeamRepository")
 */
class FootballTeam
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
     * @var string
     *
     * @ORM\Column(name="strip", type="string", length=255)
     */
    private $strip;


    /**
     * Many FootballTeam have one League.
     * @ORM\ManyToOne(targetEntity="League", inversedBy="footballTeams")
     * @ORM\JoinColumn(name="football_team_id", referencedColumnName="id")
     */
    private $league;


    /**
     * @return League|null
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param Assignment footballTeam
     */
    public function setLeague(League $league = null)
    {
        $this->league = $league;
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
     * Set name
     *
     * @param string $name
     *
     * @return footballTeam
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set strip
     *
     * @param string $strip
     *
     * @return footballTeam
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * Get strip
     *
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }
}

