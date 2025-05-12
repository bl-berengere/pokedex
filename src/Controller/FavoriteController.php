<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FavoriteController extends AbstractController
{
    #[Route('/favorite', name: 'app_favorite')]
    public function index(): Response
    {
        $user = $this->getUser();

        $favoritePokemons = [];

        if ($user){
            $favoritePokemons = $user->getFavorite();
        }

        return $this->render('favorite/index.html.twig', [
            'favoritePokemons' => $favoritePokemons,
        ]);

    }

    #[Route('/favorite/add/{id}', name: 'app_favorite_add', methods: ['POST'])]
    public function add(Pokemon $pokemon, EntityManagerInterface $entityManager ): Response
    {
        $user = $this->getUser();
        $user->addFavorite($pokemon);
        $entityManager->flush();

        return $this->json(['success' => true]);

    }

    #[Route('/favorite/remove/{id}', name: 'app_favorite_remove', methods: ['POST'])]
    public function remove(Pokemon $pokemon, EntityManagerInterface $entityManager ): Response
    {
        $user = $this->getUser();
        $user->removeFavorite($pokemon);
        $entityManager->flush();

        return $this->json(['success' => true]);

    }
}
