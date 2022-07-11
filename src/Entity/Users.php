<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Serializable;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @UniqueEntity(fields={"name"}, message="Dane nie są unikatowe")
 * @UniqueEntity(fields={"surname"}, message="Dane nie są unikatowe")
 */
class Users
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=16, nullable=false, unique=true)
     */
    private string $name;

    /**
     * @ORM\Column(name="surname", type="string", length=16, nullable=false, unique=true)
     */
    private string $surname;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'surname' => $this->getSurname()
        ];
    }

}
