<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Service\AnimalManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimalController extends AbstractController
{
    /**
     * Liste des Animaux
     * 
     * @param AnimalManager $animalManager Gestionnaire d'entité Animal
     * 
     * @return Response
     * @Route("/animal", name="animal")
     */
    public function list(AnimalManager $animalManager): Response
    {
        $animals = $animalManager->listAnimal();

        return $this->render(
            'animal/index.html.twig',
            [
                'animals' => $animals,
            ]
        );
    }

    /**
     * Affiche le détail d'un animal
     * 
     * @param Animal $animal Entité Animal
     * 
     * @return Response
     * @Route("/animal/{id<\d+>}", name="game_show", methods={"POST", "GET"})
     */
    public function show(Animal $animal): Response
    {
        return $this->render(
            'animal/single.html.twig',
            [
                'animal' => $animal,
            ]
        );
    }
}
