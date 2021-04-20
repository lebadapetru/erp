<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table("`users`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    private string $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isActive = true;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $verified_at;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="users")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, mappedBy="users")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity=EmailToken::class, mappedBy="user", orphanRemoval=true)
     */
    private $emailTokens;

    /**
     * @ORM\OneToMany(targetEntity=ResetPasswordToken::class, mappedBy="user", orphanRemoval=true)
     */
    private $resetPasswordTokens;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->emailTokens = new ArrayCollection();
        $this->resetPasswordTokens = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return (string)$this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getVerifiedAt(): ?\DateTimeInterface
    {
        return $this->verified_at;
    }

    public function setVerifiedAt(?\DateTimeInterface $verified_at): self
    {
        $this->verified_at = $verified_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * @return Collection|Role[]
     */
    public function getRoles()
    {
        //add roles of the user's group to the roles of the user
        foreach ($this->groups as $group) {
            foreach ($group->getRoles() as $role) {
                $this->addRoles($role);
            }
        }

        return $this->roles->map(function ($role) {
            return $role->getLabel();
        })->toArray();
    }

    public function addRoles(Role $roles): self
    {
        if (!$this->roles->contains($roles)) {
            $this->roles[] = $roles;
        }

        return $this;
    }

    public function removeRoles(Role $roles): self
    {
        if ($this->roles->contains($roles)) {
            $this->roles->removeElement($roles);
        }

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->addUser($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
            $group->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|EmailToken[]
     */
    public function getEmailTokens(): Collection
    {
        return $this->emailTokens;
    }

    public function addEmailToken(EmailToken $emailTokens): self
    {
        if (!$this->emailTokens->contains($emailTokens)) {
            $this->emailTokens[] = $emailTokens;
            $emailTokens->setUser($this);
        }

        return $this;
    }

    public function removeEmailTokens(EmailToken $emailTokens): self
    {
        if ($this->emailTokens->removeElement($emailTokens)) {
            // set the owning side to null (unless already changed)
            if ($emailTokens->getUser() === $this) {
                $emailTokens->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ResetPasswordToken[]
     */
    public function getResetPasswordTokens(): Collection
    {
        return $this->resetPasswordTokens;
    }

    public function addResetPasswordToken(ResetPasswordToken $resetPasswordToken): self
    {
        if (!$this->resetPasswordTokens->contains($resetPasswordToken)) {
            $this->resetPasswordTokens[] = $resetPasswordToken;
            $resetPasswordToken->setUser($this);
        }

        return $this;
    }

    public function removeResetPasswordToken(ResetPasswordToken $resetPasswordToken): self
    {
        if ($this->resetPasswordTokens->removeElement($resetPasswordToken)) {
            // set the owning side to null (unless already changed)
            if ($resetPasswordToken->getUser() === $this) {
                $resetPasswordToken->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return isset($this->verified_at);
    }

    public function getActiveEmailToken(): ?EmailToken
    {
        $activeTokens = $this->emailTokens->filter(function ($emailToken) {
            /** @var $emailToken EmailToken */
            return $emailToken->isActive();
        });

        if ($activeTokens->isEmpty()) {
            return null;
        }

        return $activeTokens->first();
    }
}
