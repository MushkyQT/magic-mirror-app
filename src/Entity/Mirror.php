<?php

namespace App\Entity;

use App\Repository\MirrorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MirrorRepository::class)
 */
class Mirror
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $identifierCode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isIdentified;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $ipAddress;

    /**
     * @ORM\ManyToOne(targetEntity=Habitat::class, inversedBy="mirrors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $habitat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifierCode(): ?string
    {
        return $this->identifierCode;
    }

    public function setIdentifierCode(string $identifierCode): self
    {
        $this->identifierCode = $identifierCode;

        return $this;
    }

    public function getIsIdentified(): ?bool
    {
        return $this->isIdentified;
    }

    public function setIsIdentified(bool $isIdentified): self
    {
        $this->isIdentified = $isIdentified;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }
}
