<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\ManyToMany(targetEntity:Student::class, inversedBy:"clubs")]


class Club
{
    private $students;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $REF = null;

    #[ORM\Column(length: 25)]
    private ?string $createdat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getREF(): ?int
    {
        return $this->REF;
    }

    public function setREF(int $REF): self
    {
        $this->REF = $REF;

        return $this;
    }

    public function getCreatedat(): ?string
    {
        return $this->createdat;
    }

    public function setCreatedat(string $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }
}
