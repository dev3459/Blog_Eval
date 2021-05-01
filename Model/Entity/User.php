<?php
namespace Model\Entity;

class User {
    private ?int $id;
    private ?string $username;
    private ?string $password;
    private ?int $admin;
    private ?string $date;

    /**
     * User constructor.
     * @param string|null $username
     * @param string|null $password
     * @param int|null $admin
     * @param int|null $id
     * @param string|null
     */
    public function __construct(string $username = null, string $password = null, int $admin = null, int $id = null, string $date = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAdmin(): ?int
    {
        return $this->admin;
    }

    /**
     * @param int|null $admin
     * @return $this
     */
    public function setAdmin(?int $admin): User
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }
}