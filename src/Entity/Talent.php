<?php

namespace App\Entity;

use App\Repository\TalentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TalentRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'Ce talent existe déjà')]
class Talent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\ManyToMany(targetEntity: Pokemon::class, mappedBy: 'talents')]
    private Collection $pokemon;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'talent')]
    private Collection $talent_pokemon;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
        $this->talent_pokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemon $pokemon): static
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon->add($pokemon);
            $pokemon->addTalent($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): static
    {
        if ($this->pokemon->removeElement($pokemon)) {
            $pokemon->removeTalent($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getTalentPokemon(): Collection
    {
        return $this->talent_pokemon;
    }

    public function addTalentPokemon(Pokemon $talentPokemon): static
    {
        if (!$this->talent_pokemon->contains($talentPokemon)) {
            $this->talent_pokemon->add($talentPokemon);
            $talentPokemon->setTalent($this);
        }

        return $this;
    }

    public function removeTalentPokemon(Pokemon $talentPokemon): static
    {
        if ($this->talent_pokemon->removeElement($talentPokemon)) {
            // set the owning side to null (unless already changed)
            if ($talentPokemon->getTalent() === $this) {
                $talentPokemon->setTalent(null);
            }
        }

        return $this;
    }
}
