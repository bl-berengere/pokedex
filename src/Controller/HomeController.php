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

        return $this->render('home/index.html.twig', [
            'pokemons' => $pokemons,
        ]);
    }

    #[Route('/pokemon/{id}', name: 'pokemon_show')]
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }
}
