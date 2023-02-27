<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\ManyToMany(targetEntity:Club::class, mappedBy:"students")]
class Student
{
    private $clubs;
    public function __construct()
{
    $this->students = new ArrayCollection();
    $this->clubs = new ArrayCollection();
}

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nsc = null;

    #[ORM\Column(length: 25)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNsc(): ?int
    {
        return $this->nsc;
    }

    public function setNsc(int $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function addClub(Club $club): self
{
    if (!$this->clubs->contains($club)) {
        $this->clubs[] = $club;
        $club->addStudent($this);
    }

    return $this;
}

public function removeClub(Club $club): self
{
    if ($this->clubs->removeElement($club)) {
        $club->removeStudent($this);
    }

    return $this;
}
}
