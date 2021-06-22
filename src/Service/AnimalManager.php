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
     * AnimalManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Liste des entités Animal
     *
     * @return array
     */
   public function listAnimal(): array
   {
        return $this->em->getRepository(Animal::class)->findAll();
   }
}
