<?php

namespace App\Service;

use Exception;
use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Gestionnaire de l'entité Animal
 *
 * @package App\Service
 */
class AnimalManager
{
    private $em;

    /**
     * BibleManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Liste des articles
     *
     * @param Request                $request   La requête courante
     * @param PaginatorInterface     $paginator Gestionnaire de pagination
     * @param EntityManagerInterface $em        Gestionnaire des entités
     *
     * @return array
     */
   public function listAnimal(): array
   {
        return $this->em->getRepository(Animal::class)->findAll();
   }
}
