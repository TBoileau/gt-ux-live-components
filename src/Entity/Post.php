<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity]
class Post
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    public ?int $id = null;

    #[NotBlank]
    #[Column(type: Types::STRING)]
    public ?string $title = null;

    #[NotBlank]
    #[Length(min: 10)]
    #[Column(type: Types::TEXT)]
    public ?string $content = null;

    #[NotBlank]
    #[GreaterThan('now')]
    #[Column(type: Types::DATETIME_IMMUTABLE)]
    public ?DateTimeImmutable $publishedAt = null;
}
