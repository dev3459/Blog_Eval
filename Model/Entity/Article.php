<?php
namespace Model\Entity;

class Article {
    private string $content;
    private User $user;
    private string $title;
    private ?string $date;
    private ?int $id;

    /**
     * Article constructor.
     * @param string $content
     * @param User $user
     * @param string $title
     * @param string|null $date
     * @param int|null $id
     */
    public function __construct(string $content, User $user, string $title, string $date = null, int $id = null) {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
        $this->date = $date;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        $day = substr($this->date, 8, 2);
        $month = substr($this->date, 5, 2);
        $years = substr($this->date, 0, 4);
        $hours = substr($this->date,  10, 6);
        return $day . "/" . $month . "/" . $years . " à " . $hours;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }
}