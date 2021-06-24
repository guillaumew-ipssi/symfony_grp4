<?php

namespace App\Service;

use Exception;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Gestionnaire de l'entité Donation
 *
 * @package App\Service
 */
class UserManager
{
    private $em;
    private $security;
    private $passwordEncoder;

    /**
     * DonationManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(EntityManagerInterface $em, Security $security, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Créer un utilisateur
     * 
     * @param User $user Entité $donation
     *
     * @return User
     */
    public function createUser(User $user): User
    {
        $passwordEncod = $this->passwordEncoder->encodePassword($user, $user->getPassword());

        $user->setPassword($passwordEncod);

        $this->em->persist($user);

        $this->em->flush();

        return $user;
    }
}
