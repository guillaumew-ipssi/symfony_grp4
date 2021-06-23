<?php

namespace App\Controller;

use App\Entity\Adopt;
use App\Entity\Animal;
use App\Form\AdoptType;
use App\Service\AnimalManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @Route("/animal/{id<\d+>}", name="animal_show", methods={"POST", "GET"})
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

    /**
     * Adopter un animal
     * 
     * @param Animal $animal Entité Animal
     * 
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/animal/adopt/{id<\d+>}", name="animal_adopt", methods={"POST", "GET"})
     */
    public function adopt(AnimalManager $animalManager, Animal $animal): Response
    {
        $adopt = new Adopt($this->getUser());

        $form = $this->createForm(
            AdoptType::class, $adopt);

        if($form->isSubmitted() && $form->isValid()) {
            dd('er');
            try {
                $animalManager->adoptAnimal($animal);

            } catch (\Exception $e) {
                
            }
        }

        return $this->render(
            'animal/adopt.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
