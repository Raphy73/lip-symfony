<?php

namespace App\Entity;

use App\Repository\SuggestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Department::class, mappedBy="suggestion")
     */
    private $Department;

    /**
     * @ORM\OneToMany(targetEntity=Domain::class, mappedBy="suggestion")
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $date_end;

    /**
     * @ORM\OneToMany(targetEntity=TypeOfProject::class, mappedBy="suggestion")
     */
    private $type_of_project;

    public function __construct()
    {
        $this->Department = new ArrayCollection();
        $this->domain = new ArrayCollection();
        $this->type_of_project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartment(): Collection
    {
        return $this->Department;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->Department->contains($department)) {
            $this->Department[] = $department;
            $department->setSuggestion($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        if ($this->Department->removeElement($department)) {
            // set the owning side to null (unless already changed)
            if ($department->getSuggestion() === $this) {
                $department->setSuggestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Domain>
     */
    public function getDomain(): Collection
    {
        return $this->domain;
    }

    public function addDomain(Domain $domain): self
    {
        if (!$this->domain->contains($domain)) {
            $this->domain[] = $domain;
            $domain->setSuggestion($this);
        }

        return $this;
    }

    public function removeDomain(Domain $domain): self
    {
        if ($this->domain->removeElement($domain)) {
            // set the owning side to null (unless already changed)
            if ($domain->getSuggestion() === $this) {
                $domain->setSuggestion(null);
            }
        }

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

    public function getDateEnd(): ?int
    {
        return $this->date_end;
    }

    public function setDateEnd(?int $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return Collection<int, TypeOfProject>
     */
    public function getTypeOfProject(): Collection
    {
        return $this->type_of_project;
    }

    public function addTypeOfProject(TypeOfProject $typeOfProject): self
    {
        if (!$this->type_of_project->contains($typeOfProject)) {
            $this->type_of_project[] = $typeOfProject;
            $typeOfProject->setSuggestion($this);
        }

        return $this;
    }

    public function removeTypeOfProject(TypeOfProject $typeOfProject): self
    {
        if ($this->type_of_project->removeElement($typeOfProject)) {
            // set the owning side to null (unless already changed)
            if ($typeOfProject->getSuggestion() === $this) {
                $typeOfProject->setSuggestion(null);
            }
        }

        return $this;
    }
}
