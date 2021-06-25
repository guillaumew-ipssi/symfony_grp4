<?php

namespace App\Service;

use Exception;
use App\Entity\User;
use App\Entity\Adopt;
use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Gestionnaire de l'entité Animal
 *
 * @package App\Service
 */
class AnimalManager
{
    private $em;
    private $security;

    /**
     * AnimalManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
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

    /**
     * Adopter un animal
     * 
     * @param Animal $animal Entité Animal
     * @param Adopt $adopt Entité Adopt
     *
     * @return Animal
     */
    public function adoptAnimal(Animal $animal, Adopt $adopt): Animal
    {
        $animal->setAdopt($adopt);

        $this->em->flush();

        return $animal;
    }
}
