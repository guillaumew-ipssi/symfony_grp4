<?php

namespace App\Service;

use Exception;
use App\Entity\User;
use App\Entity\Adopt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Gestionnaire de l'entité Animal
 *
 * @package App\Service
 */
class AdoptManager
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
    public function getLastAdopted(): array
    {
        return $this->em->getRepository(Adopt::class)->findLastAdoptedAnimals();
    }

    /**
     * Créer un adopteur
     * 
     * @param Adopt $adopt Entité Adopt
     *
     * @return Adopt
     */
    public function createAdopt(Adopt $adopt): Adopt
    {
        $this->em->persist($adopt);

        $this->em->flush();

        return $adopt;
    }

}
