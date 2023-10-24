<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

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
        minMessage: 'Votre pseudo doit contenir au minimum {{ limit }} caractères',
        maxMessage: 'Votre pseudo doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $pseudo = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length:255)]
    #[Assert\NotCompromisedPassword]
    #[Assert\PasswordStrength(minScore: PasswordStrength::STRENGTH_STRONG)]
    #[Assert\Length(
        min: 8,
        minMessage: 'Votre mot de passe doit contenir au minimum {{ limit }} caractères',
    )]
    private string $password;

    #[ORM\Column(length: 255)]
    private ?string $email = null;
    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at;
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: 'boolean')]
    private ?bool $isVerified = false;
    #[Assert\Length(
        min: 8,
        minMessage: 'Your first name must be at least {{ 8 }} characters long',
    )]

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
        // guarantee every user at least has user
        $roles[] = 'user';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
//
//    /**
//     * @return Collection<int, UserQuizzScore>
//     */
//    public function getUserQuizzScores(): Collection
//    {
//        return $this->userQuizzScores;
//    }
//    public function addUserQuizzScore(UserQuizzScore $userQuizzScore): static
//    {
//        if (!$this->userQuizzScores->contains($userQuizzScore)) {
//            $this->userQuizzScores->add($userQuizzScore);
//            $userQuizzScore->setUser($this);
//        }
//
//        return $this;
//    }
//    public function removeUserQuizzScore(UserQuizzScore $userQuizzScore): static
//    {
//        if ($this->userQuizzScores->removeElement($userQuizzScore)) {
//            // set the owning side to null (unless already changed)
//            if ($userQuizzScore->getUser() === $this) {
//                $userQuizzScore->setUser(null);
//            }
//        }
//        return $this;
//    }
}
