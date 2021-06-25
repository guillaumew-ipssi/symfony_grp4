<?php

namespace App\Service;

use Exception;
use App\Entity\Donation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Gestionnaire de l'entité Donation
 *
 * @package App\Service
 */
class DonationManager
{
    private $em;
    private $security;

    /**
     * DonationManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * Liste des entités Donation
     *
     * @return array
     */
   public function listDonation(): array
   {
        return $this->em->getRepository(Donation::class)->findAll();
   }

    /**
     * Créer une donation
     * 
     * @param Donation $donation Entité $donation
     *
     * @return Donation
     */
    public function createDonation(Donation $donation): Donation
    {
        $this->em->persist($donation);

        $this->em->flush();

        return $donation;
    }
}
