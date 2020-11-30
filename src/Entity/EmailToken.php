<?php

namespace App\Entity;

use App\Repository\EmailTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=EmailTokenRepository::class)
 * @ORM\Table("`email_tokens`")
 */
class EmailToken
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    private Uuid $token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $expiredAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(Uuid $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
