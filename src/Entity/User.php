<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15, unique: true)]
    #[Assert\Length(
        min: 3,
        max: 15,
        minMessage: 'Your first name must be at least {{ 3 }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ 15 }} characters',
    )]
    private ?string $pseudo = null;

   /*  à vérifier */
    #[ORM\Column(length: 30)]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length:255)]
    #[Assert\Length(
        min: 8,
        minMessage: 'Your first name must be at least {{ 8 }} characters long',
    )]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?bool $validated = false;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserQuizzScore::class, orphanRemoval: true)]
    private Collection $userQuizzScores;

    public function __construct()
    {
        $this->userQuizzScores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->pseudo;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): static
    {
        $this->validated = $validated;

        return $this;
    }

    public function getRole(): ?string
    {
        $role[] = 'ROLE_USER';
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, UserQuizzScore>
     */
    public function getUserQuizzScores(): Collection
    {
        return $this->userQuizzScores;
    }

    public function addUserQuizzScore(UserQuizzScore $userQuizzScore): static
    {
        if (!$this->userQuizzScores->contains($userQuizzScore)) {
            $this->userQuizzScores->add($userQuizzScore);
            $userQuizzScore->setUser($this);
        }

        return $this;
    }

    public function removeUserQuizzScore(UserQuizzScore $userQuizzScore): static
    {
        if ($this->userQuizzScores->removeElement($userQuizzScore)) {
            // set the owning side to null (unless already changed)
            if ($userQuizzScore->getUser() === $this) {
                $userQuizzScore->setUser(null);
            }
        }

        return $this;
    }
}
