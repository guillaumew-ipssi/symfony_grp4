<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Form\DonationType;
use App\Service\DonationManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DonationController extends AbstractController
{
    private $donationManager;

    /**
     * DonationManager constructor.
     *
     * @param EntityManagerInterface $em Gestionnaire d'entité
     */
    public function __construct(DonationManager $donationManager)
    {
        $this->donationManager = $donationManager;
    }

    /**

     * Affiche les donations
     * 
     * @return Response
     * @Route("/donation", name="donation")
     */
    public function list(): Response
    {
        $donations = $this->donationManager->listDonation();

        return $this->render(
            'donation/index.html.twig',
            [
                'donations' => $donations,
            ]
        );
    }

     /**
     * Faire une donation
     * 
     * @param Request  $request   La requête courante
     * 
     * @return Response
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/donation/new", name="donation_new")
     */
    public function edit(Request $request): Response
    {
         // @TODO Check url valid (votter)
         $donation = new Donation($this->getUser());

         $form = $this->createForm(
            DonationType::class, $donation);
 
         $form->handleRequest($request);
 
         if($form->isSubmitted() && $form->isValid()) {
             try {
                 $this->donationManager->createDonation($donation);
                //  $adoptManager->createAdopt($adopt);
                //  $animalManager->adoptAnimal($animal, $adopt);
 
                 $this->addFlash('success', "Votre donation a été effectuée <3");
             } catch (\Exception $e) {
                 $this->addFlash('error', "Une erreur est survenue." . $e);
             }
 
             return $this->redirectToRoute('donation');
         }
 
         return $this->render(
             'donation/edit.html.twig',
             [
                 'form' => $form->createView(),
             ]
         );
    }
}
