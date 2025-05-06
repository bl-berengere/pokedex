<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PokemonRepository;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $pokemons = $pokemonRepository->findAll();
        $user = $this->getUser();

        $favoritePokemons = [];
        $favoritePokemonIds = [];

        if ($user){
            $favoritePokemons = $user->getFavorite()->toArray();
            $favoritePokemonIds = $user->getFavorite()->map(fn($p) => $p->getId())->toArray();
        }

        return $this->render('home/index.html.twig', [
            'pokemons' => $pokemons,
            'favoritePokemons' => $favoritePokemons,
            'favoritePokemonIds' => $favoritePokemonIds,
        ]);
    }

}
