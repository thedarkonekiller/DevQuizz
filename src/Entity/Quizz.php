<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzRepository::class)]
class Quizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $img = null;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: UserQuizzScore::class, orphanRemoval: true)]
    private Collection $userQuizzScores;

    #[ORM\Column(length: 255, options: ["default" => 'draft'])]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $nb_questions = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: Question::class)]
    private Collection $questions;

    public function __construct()
    {
        $this->userQuizzScores = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

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
            $userQuizzScore->setQuizz($this);
        }

        return $this;
    }

    public function removeUserQuizzScore(UserQuizzScore $userQuizzScore): static
    {
        if ($this->userQuizzScores->removeElement($userQuizzScore)) {
            // set the owning side to null (unless already changed)
            if ($userQuizzScore->getQuizz() === $this) {
                $userQuizzScore->setQuizz(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNbQuestions(): ?int
    {
        return $this->nb_questions;
    }

    public function setNbQuestions(int $nb_questions): static
    {
        $this->nb_questions = $nb_questions;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuizz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuizz() === $this) {
                $question->setQuizz(null);
            }
        }

        return $this;
    }
}
