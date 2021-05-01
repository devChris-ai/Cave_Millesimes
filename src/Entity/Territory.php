<?php

namespace App\Entity;

use App\Repository\TerritoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TerritoryRepository::class)
 */
class Territory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Denomination::class, mappedBy="territory")
     */
    private $denominations;

    public function __construct()
    {
        $this->denominations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Denomination[]
     */
    public function getDenominations(): Collection
    {
        return $this->denominations;
    }

    public function addDenomination(Denomination $denomination): self
    {
        if (!$this->denominations->contains($denomination)) {
            $this->denominations[] = $denomination;
            $denomination->setTerritory($this);
        }

        return $this;
    }

    public function removeDenomination(Denomination $denomination): self
    {
        if ($this->denominations->removeElement($denomination)) {
            // set the owning side to null (unless already changed)
            if ($denomination->getTerritory() === $this) {
                $denomination->setTerritory(null);
            }
        }

        return $this;
    }
}
