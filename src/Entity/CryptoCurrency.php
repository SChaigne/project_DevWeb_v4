<?php

namespace App\Entity;

use App\Repository\CryptoCurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CryptoCurrencyRepository::class)
 */
class CryptoCurrency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $symbol;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marketcap;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_follow_tt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getsymbol(): ?string
    {
        return $this->symbol;
    }

    public function setsymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMarketcap(): ?float
    {
        return $this->marketcap;
    }

    public function setMarketcap(?float $marketcap): self
    {

        $this->marketcap = $marketcap;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNbFollowTt(): ?int
    {
        return $this->nb_follow_tt;
    }

    public function setNbFollowTt(?int $nb_follow_tt): self
    {
        $this->nb_follow_tt = $nb_follow_tt;

        return $this;
    }
}
