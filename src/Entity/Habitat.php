<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=HabitatRepository::class)
 */
class Habitat
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetAddress;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $displayName;

    /**
     * @ORM\Column(type="bigint", unique=true)
     */
    private $macAddress;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="habitats")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Mirror::class, mappedBy="habitat", orphanRemoval=true)
     */
    private $mirrors;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->mirrors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getMacAddress(): ?string
    {
        return $this->macAddress;
    }

    public function setMacAddress(string $macAddress): self
    {
        $this->macAddress = $macAddress;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addHabitat($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeHabitat($this);
        }

        return $this;
    }

    /**
     * @return Collection|Mirror[]
     */
    public function getMirrors(): Collection
    {
        return $this->mirrors;
    }

    public function addMirror(Mirror $mirror): self
    {
        if (!$this->mirrors->contains($mirror)) {
            $this->mirrors[] = $mirror;
            $mirror->setHabitat($this);
        }

        return $this;
    }

    public function removeMirror(Mirror $mirror): self
    {
        if ($this->mirrors->removeElement($mirror)) {
            // set the owning side to null (unless already changed)
            if ($mirror->getHabitat() === $this) {
                $mirror->setHabitat(null);
            }
        }

        return $this;
    }
}
