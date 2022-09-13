<?php

declare(strict_types=1);

namespace App\Component;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('post_form')]
final class PostFormComponent extends AbstractController
{
    use DefaultActionTrait, ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?Post $post = null;

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager): void
    {
        $this->submitForm();

        /** @var Post $post */
        $post = $this->getFormInstance()->getData();

        if ($entityManager->getUnitOfWork()->getEntityState($post) === UnitOfWork::STATE_NEW) {
            $entityManager->persist($post);
        }

        $entityManager->flush();
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(PostType::class, $this->post);
    }
}
