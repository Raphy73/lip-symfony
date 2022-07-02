<?php

namespace App\Entity;

use App\Repository\DomainRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomainRepository::class)
 */
class Domain
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="domain")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Suggestion::class, inversedBy="domain")
     */
    private $suggestion;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOfProject::class, inversedBy="domain")
     */
    private $typeOfProject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSuggestion(): ?Suggestion
    {
        return $this->suggestion;
    }

    public function setSuggestion(?Suggestion $suggestion): self
    {
        $this->suggestion = $suggestion;

        return $this;
    }

    public function getTypeOfProject(): ?TypeOfProject
    {
        return $this->typeOfProject;
    }

    public function setTypeOfProject(?TypeOfProject $typeOfProject): self
    {
        $this->typeOfProject = $typeOfProject;

        return $this;
    }
}
