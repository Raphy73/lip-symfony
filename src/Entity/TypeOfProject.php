<?php

namespace App\Entity;

use App\Repository\TypeOfProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeOfProjectRepository::class)
 */
class TypeOfProject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Domain::class, mappedBy="typeOfProject")
     */
    private $domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Suggestion::class, inversedBy="type_of_project")
     */
    private $suggestion;

    public function __construct()
    {
        $this->domain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $domain->setTypeOfProject($this);
        }

        return $this;
    }

    public function removeDomain(Domain $domain): self
    {
        if ($this->domain->removeElement($domain)) {
            // set the owning side to null (unless already changed)
            if ($domain->getTypeOfProject() === $this) {
                $domain->setTypeOfProject(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
