<?php

namespace App\Entity;

use App\Repository\HabitantProfileRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=HabitantProfileRepository::class)
 */
class HabitantProfile
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $habitantId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recognitionCode;

    /**
     * @ORM\Column(type="json")
     */
    private $data = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHabitantId(): ?User
    {
        return $this->habitantId;
    }

    public function setHabitantId(User $habitantId): self
    {
        $this->habitantId = $habitantId;

        return $this;
    }

    public function getRecognitionCode(): ?string
    {
        return $this->recognitionCode;
    }

    public function setRecognitionCode(string $recognitionCode): self
    {
        $this->recognitionCode = $recognitionCode;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}
