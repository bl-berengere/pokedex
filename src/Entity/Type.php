<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    private ?string $backgroundColor = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\ManyToMany(targetEntity: Pokemon::class, mappedBy: 'types')]
    private Collection $pokemon;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\ManyToMany(targetEntity: Pokemon::class, mappedBy: 'weaknesses')]
    private Collection $pokemonWeakness;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
        $this->pokemonWeakness = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(string $backgroundColor): static
    {
        $this->backgroundColor = $backgroundColor;

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
            $pokemon->addType($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): static
    {
        if ($this->pokemon->removeElement($pokemon)) {
            $pokemon->removeType($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemonWeakness(): Collection
    {
        return $this->pokemonWeakness;
    }

    public function addPokemonWeakness(Pokemon $pokemonWeakness): static
    {
        if (!$this->pokemonWeakness->contains($pokemonWeakness)) {
            $this->pokemonWeakness->add($pokemonWeakness);
            $pokemonWeakness->addWeakness($this);
        }

        return $this;
    }

    public function removePokemonWeakness(Pokemon $pokemonWeakness): static
    {
        if ($this->pokemonWeakness->removeElement($pokemonWeakness)) {
            $pokemonWeakness->removeWeakness($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
