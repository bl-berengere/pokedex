<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PokemonRepository;


final class PokemonController extends AbstractController
{
    #[Route('/pokemon/{id}', name: 'pokemon_show')]
    public function show(Pokemon $pokemon, PokemonRepository $pokemonRepository): Response
    {
    $numero = $pokemon->getNumero();

    $prev = $pokemonRepository->findOneBy(['numero' => $numero - 1]);
    $next = $pokemonRepository->findOneBy(['numero' => $numero + 1]);

    return $this->render('pokemon/show.html.twig', [
        'pokemon' => $pokemon,
        'prevPokemon' => $pokemonRepository->findOneBy(['numero' => $pokemon->getNumero() - 1]),
        'nextPokemon' => $pokemonRepository->findOneBy(['numero' => $pokemon->getNumero() + 1]),
        'previousEvolution' => $pokemon->getEvolutionPrecedente(),
        'nextEvolutions' => $pokemon->getEvolutions(),
        'evolutionLine' => $pokemon->getFullEvolutionLine(),

    ]);

    }


}