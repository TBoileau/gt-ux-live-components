<?php

declare(strict_types=1);

namespace App\Component;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('post_list')]
final class PostListComponent
{
    use DefaultActionTrait;

    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * @return array<array-key, Post>
     */
    public function getPosts(): array
    {
        return $this->postRepository->findAll();
    }
}
