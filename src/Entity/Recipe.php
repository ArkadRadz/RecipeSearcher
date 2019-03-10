<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredients = [];

    /** @var Collection|Ingredient[] */
    private $ingColl;

    /**
     * @ORM\Column(type="time")
     */
    private $estimated_time_to_make;

    /**
     * @ORM\Column(type="integer")
     */
    private $estimated_difficulty;

    /**
     * @ORM\Column(type="array")
     */
    private $steps_to_make = [];

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->steps_to_make = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getEstimatedTimeToMake(): ?\DateTimeInterface
    {
        return $this->estimated_time_to_make;
    }

    public function setEstimatedTimeToMake(\DateTimeInterface $estimated_time_to_make): self
    {
        $this->estimated_time_to_make = $estimated_time_to_make;

        return $this;
    }

    public function getEstimatedDifficulty(): ?int
    {
        return $this->estimated_difficulty;
    }

    public function setEstimatedDifficulty(int $estimated_difficulty): self
    {
        $this->estimated_difficulty = $estimated_difficulty;

        return $this;
    }

    public function getStepsToMake(): ?array
    {
        return $this->steps_to_make;
    }

    public function setStepsToMake(array $steps_to_make): self
    {
        $this->steps_to_make = $steps_to_make;

        return $this;
    }
}
