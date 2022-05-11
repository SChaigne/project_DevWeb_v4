<?php

namespace App\Entity;

use App\Repository\SubscribeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscribeRepository::class)
 */
class Subscribe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="subscribes")
     */
    private $id_user;

    /**
     * @ORM\ManyToMany(targetEntity=CryptoCurrency::class, inversedBy="subscribes")
     */
    private $id_crypto;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
        $this->id_crypto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        $this->id_user->removeElement($idUser);

        return $this;
    }

    /**
     * @return Collection<int, CryptoCurrency>
     */
    public function getIdCrypto(): Collection
    {
        return $this->id_crypto;
    }

    public function addIdCrypto(CryptoCurrency $idCrypto): self
    {
        if (!$this->id_crypto->contains($idCrypto)) {
            $this->id_crypto[] = $idCrypto;
        }

        return $this;
    }

    public function removeIdCrypto(CryptoCurrency $idCrypto): self
    {
        $this->id_crypto->removeElement($idCrypto);

        return $this;
    }
}
