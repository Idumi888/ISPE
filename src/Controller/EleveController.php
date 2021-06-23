<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Eleve;
use App\Entity\Concerne;
use App\Entity\Epreuve;
use App\Form\AjoutEleveType;
use App\Form\ModifEleveType;
class EleveController extends AbstractController
{
    /**
     * @Route("/liste_eleves", name="liste_eleves")
     */
    public function liste_eleves(Request $request): Response
    {
        $em = $this->getDoctrine();
        $repoEleve = $em->getRepository(Eleve::class);
        if ($request->get('supp') != null) {
            $eleve = $repoEleve->find($request->get('supp'));
            if ($eleve != null) {
                $em->getManager()->remove($eleve);
                $em->getManager()->flush();
            }
            return $this->redirectToRoute('liste_eleves');
        }
        $eleves = $repoEleve->findBy(array(), array('nom' => 'ASC'));
        return $this->render('eleve/liste_eleves.html.twig', [
            'eleve' => $eleves 
        ]);
    }


    /**
     * @Route("/ajout_eleve", name="ajout_eleve")
     */
    public function ajoutEleve(Request $request)
    {
        $eleve = new Eleve(); 
        $form = $this->createForm(AjoutEleveType::class, $eleve);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $file = $form->get('photo')->getData();
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $eleve->setPhoto($fileName); 

                try {
                    
                    $file->move($this->getParameter('profile_directory'), $fileName); 
                    $em = $this->getDoctrine()->getManager();
                    $eleve->setPhoto($fileName);
                    $em->persist($eleve);
                    $em->flush();
                    $this->addFlash('notice', 'Fichier inséré');
                } catch (FileException $e) {
                    $this->addFlash('notice', 'Problème fichier inséré');
                }
                
            }
        }
       

        return $this->render('eleve/ajout_eleve.html.twig', [
            'form' => $form->createView() 
        ]);
    }
     /**
     * * @return string
     *
     * */
    private function generateUniqueFileName()
    {
        return md5(uniqid()); // Génère un md5 sur un identifiant généré aléatoirement
    }
    
}
