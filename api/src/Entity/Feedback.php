<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 1,
        max: 255,
        minMessage: 'Поле Имя должно содержать хотя бы один символ',
        maxMessage: 'Поле Имя не может содержать более 255 символов'
    )]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 10000,
        max: 99999999,
        notInRangeMessage: 'Телефон должен быть натуральным числом от 5 до 8 знаков'
    )]
    private ?int $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $ip = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getNamePhoneAndCreatedAt(): array
    {
        return [
            'name' => $this->getName(),
            'phone' => $this->getPhone(),
            'created_at' => $this->getCreatedAt()->format('Y/m/d h:i:s')
        ];
    }
}
