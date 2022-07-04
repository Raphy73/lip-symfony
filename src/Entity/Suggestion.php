<?php

namespace App\Entity;

use App\Repository\SuggestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuggestionRepository::class)
 */
class Suggestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Domain::class, inversedBy="suggestions")
     */
    private $domain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_students;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_groups;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_hours;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_end;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getNumberOfStudents(): ?int
    {
        return $this->number_of_students;
    }

    public function setNumberOfStudents(?int $number_of_students): self
    {
        $this->number_of_students = $number_of_students;

        return $this;
    }

    public function getNumberOfGroups(): ?int
    {
        return $this->number_of_groups;
    }

    public function setNumberOfGroups(?int $number_of_groups): self
    {
        $this->number_of_groups = $number_of_groups;

        return $this;
    }

    public function getNumberOfHours(): ?int
    {
        return $this->number_of_hours;
    }

    public function setNumberOfHours(?int $number_of_hours): self
    {
        $this->number_of_hours = $number_of_hours;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(?\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}