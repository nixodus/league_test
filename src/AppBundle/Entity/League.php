<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * League
 *
 * @ORM\Table(name="league")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LeagueRepository")
 */
class League
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
     * One League can have many Football Teams.
     * @ORM\OneToMany(targetEntity="FootballTeam", mappedBy="league", cascade={"all"}, orphanRemoval=true)
     * @ORM\JoinTable(name="football_team")
     */
    private $footballTeams;


    public function __construct()
    {
        $this->footballTeams = new ArrayCollection();
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
     * @return League
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
     * @return mixed
     */
    public function getFootballTeams()
    {
        return $this->footballTeams;
    }

    /**
     * @param ArrayCollection $footballTeams
     */
    public function setFootballTeams(ArrayCollection $footballTeams = null)
    {
        $this->footballTeams = $footballTeams;
    }

    /**
     * @param FootballTeam $footballTeams
     */
    public function addFootballTeam(FootballTeam $footballTeam = null)
    {
        $footballTeam->setLeague($this);
        $this->footballTeams[] = $footballTeam;
    }


}

