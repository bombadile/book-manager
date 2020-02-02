<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 * @ORM\Entity
 * @ORM\Table(name="author")
 */
class Author extends AbstractModel
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $surname;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @var ArrayCollection|Book[]
     * @ManyToMany(targetEntity="Book", inversedBy="authors")
     * @JoinTable(name="book_author",
     *      joinColumns={@JoinColumn(name="author_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="book_id", referencedColumnName="id")}
     *      )
     */
    private $books;

    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     */
    public function __construct(string $name, string $surname, string $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @param string $name
     * @param string $surname
     */
    public function edit(string $name, string $surname): void
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @Field()
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @Field()
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Field()
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @Field()
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @Field()
     * @return \App\Model\Book[]
     */
    public function getBooks(): ?array
    {
        return $this->books->toArray();
    }
}
