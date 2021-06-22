<?php

namespace App\Controller;

use App\Service\AnimalManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
