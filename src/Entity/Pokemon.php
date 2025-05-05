<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $size = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $weight = null;

    #[ORM\ManyToOne(inversedBy: 'pokemon')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'pokemon')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Talent>
     */
    #[ORM\ManyToMany(targetEntity: Talent::class, inversedBy: 'pokemon')]
    private Collection $talents;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon')]
    private Collection $types;

    /**
     * @var Collection<int, Gender>
     */
    #[ORM\ManyToMany(targetEntity: Gender::class, inversedBy: 'pokemon')]
    private Collection $genders;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemonWeakness')]
    #[ORM\JoinTable(name: 'pokemon_weakness')]
    private Collection $weaknesses;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'evolutions')]
    private ?Pokemon $evolutionPrecedente = null;

    #[ORM\OneToMany(mappedBy: 'evolutionPrecedente', targetEntity: self::class)]
    private Collection $evolutions;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favorite')]
    private Collection $favoriteOf;


    public function __construct()
    {
        $this->talents = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->genders = new ArrayCollection();
        $this->weaknesses = new ArrayCollection();
        $this->evolutions = new ArrayCollection();
        $this->favoriteOf = new ArrayCollection();
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

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Talent>
     */
    public function getTalents(): Collection
    {
        return $this->talents;
    }

    public function addTalent(Talent $talent): static
    {
        if (!$this->talents->contains($talent)) {
            $this->talents->add($talent);
        }

        return $this;
    }

    public function removeTalent(Talent $talent): static
    {
        $this->talents->removeElement($talent);

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, Gender>
     */
    public function getGenders(): Collection
    {
        return $this->genders;
    }

    public function addGender(Gender $gender): static
    {
        if (!$this->genders->contains($gender)) {
            $this->genders->add($gender);
        }

        return $this;
    }

    public function removeGender(Gender $gender): static
    {
        $this->genders->removeElement($gender);

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getWeaknesses(): Collection
    {
        return $this->weaknesses;
    }

    public function addWeakness(Type $weakness): static
    {
        if (!$this->weaknesses->contains($weakness)) {
            $this->weaknesses->add($weakness);
        }

        return $this;
    }

    public function removeWeakness(Type $weakness): static
    {
        $this->weaknesses->removeElement($weakness);

        return $this;
    }

    public function getEvolutionPrecedente(): ?self
    {
        return $this->evolutionPrecedente;
    }

    public function setEvolutionPrecedente(?self $pokemon): static
    {
        $this->evolutionPrecedente = $pokemon;
        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getEvolutions(): Collection
    {
        return $this->evolutions;
    }


    public function getFullEvolutionLine(): array
    {
        $line = [];

        $current = $this;
        while ($current->getEvolutionPrecedente()) {
            $current = $current->getEvolutionPrecedente();
        }

        $line[] = $current;
        while (!$current->getEvolutions()->isEmpty()) {
            $current = $current->getEvolutions()->first();
            $line[] = $current;
        }

        return $line;
    }
    public function __toString(): string
    {
        return $this->name ?? 'Pokémon';
    }

    /**
     * @return Collection<int, User>
     */
    public function getFavoriteOf(): Collection
    {
        return $this->favoriteOf;
    }

    public function addFavoriteOf(User $favoriteOf): static
    {
        if (!$this->favoriteOf->contains($favoriteOf)) {
            $this->favoriteOf->add($favoriteOf);
            $favoriteOf->addFavorite($this);
        }

        return $this;
    }

    public function removeFavoriteOf(User $favoriteOf): static
    {
        if ($this->favoriteOf->removeElement($favoriteOf)) {
            $favoriteOf->removeFavorite($this);
        }

        return $this;
    }
}





