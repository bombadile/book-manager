<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book extends AbstractModel
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
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     */
    private ?int $countAuthors;

    /**
     * @ORM\Column(type="datetime_immutable", name="release_date", nullable=true)
     */
    private ?\DateTimeImmutable $releaseDate;

    /**
     * @var ArrayCollection|Author[]     *
     * @ManyToMany(targetEntity="Author", mappedBy="books")
     */
    private $authors;

    /**
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $releaseDate
     */
    public function __construct(string $title, ?string $description = null, ?\DateTimeImmutable $releaseDate = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $releaseDate
     */
    public function edit(string $title, ?string $description = null, ?\DateTimeImmutable $releaseDate = null): void
    {
        $this->title = $title;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @Field()
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    /**
     * @Field()
     * @return \App\Model\Author[]
     */
    public function getAuthors(): ?array
    {
        return $this->authors->toArray();
    }

    /**
     * @Field()
     * @return int
     */
    public function getCountAuthors(): int
    {
        return $this->authors->count();
    }
}
