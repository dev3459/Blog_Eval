<?php
namespace Model\Entity;

class Comment {
    private ?int $id;
    private ?string $content;
    private ?string $date;
    private ?User $author;

    /**
     * Comment constructor.
     * @param int|null $id
     * @param string|null $content
     * @param User|null $author
     */
    public function __construct(int $id = null, string $content = null, string $date = null, User $author = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->author = $author;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Comment
     */
    public function setContent(?string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        $dayComment = substr($this->date, 8, 2);
        $monthComment = substr($this->date, 5, 2);
        $yearsComment = substr($this->date, 0, 4);
        $hoursComment = substr($this->date,  10, 6);
        return $dayComment . "/" . $monthComment . "/" . $yearsComment . " à " . $hoursComment;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     * @return $this
     */
    public function setAuthor(?User $author): Comment
    {
        $this->author = $author;
        return $this;
    }
}