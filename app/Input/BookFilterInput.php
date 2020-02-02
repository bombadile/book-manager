<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class BookFilterInput extends AbstractInput
{
    private ?int $limit = null;

    private ?int $offset = null;

    private ?int $status = null;

    private ?\DateTimeImmutable $releaseDateStart = null;

    private ?\DateTimeImmutable $releaseDateEnd = null;

    private ?int $countAuthors = null;

    /**
     * @Field()
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @Field()
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getReleaseDateStart(): ?\DateTimeImmutable
    {
        return $this->releaseDateStart;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getReleaseDateEnd(): ?\DateTimeImmutable
    {
        return $this->releaseDateEnd;
    }

    /**
     * @param int|null $limit
     * @return self
     */
    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return self
     */
    public function setOffset(?int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $releaseDateStart
     * @return self
     */
    public function setReleaseDateStart(?\DateTimeImmutable $releaseDateStart): self
    {
        $this->releaseDateStart = $releaseDateStart;
        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $releaseDateEnd
     * @return self
     */
    public function setReleaseDateEnd(?\DateTimeImmutable $releaseDateEnd): self
    {
        $this->releaseDateEnd = $releaseDateEnd;
        return $this;
    }

    /**
     * @param int|null $countAuthors
     * @return BookFilterInput
     */
    public function setCountAuthors(?int $countAuthors): BookFilterInput
    {
        $this->countAuthors = $countAuthors;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCountAuthors(): ?int
    {
        return $this->countAuthors;
    }
}
