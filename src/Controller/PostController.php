<?php
namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/posts', name: 'post_list')]
    public function list(PostRepository $postRepository): JsonResponse
    {
        $posts = $postRepository->findBy([], ['date' => 'DESC']);
        return $this->json($posts);
    }

    #[Route('/post/delete/{id}', name: 'post_delete', methods: ['DELETE'])]
    public function delete(Post $post, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($post);
        $entityManager->flush();
        return new JsonResponse(['message' => 'Post supprimé'], 200);
    }
}
