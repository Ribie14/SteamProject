<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM/Entity(repositoryClass="App\Repository\JeuxRepository")
 */
Class Jeux
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $createur;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $categarie;

    /**
     * @ORM\Column(type="integer")
     */
    private $telechargement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(): self
    {
        
    }

    public function getCreateur(): ?string
    {
        return $this->createur;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public  function getPrix(): ?int
    {
        return $this->prix;
    }

    public  function getCategorie(): ?string
    {
        return $this->categarie;
    }

    public  function getTelechargement(): ?int
    {
        return $this->telechargement;
    }

    public  function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
}