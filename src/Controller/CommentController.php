<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Member;
use App\Form\CommentType;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    /**
     * @Route("/comment/{id}", name="comment")
     */
    public function notationMember($id,
                                   Request $request,
                                   EntityManagerInterface $em)
    {
        $memberRepo = $this->getDoctrine()->getRepository(Member::class);
        //récupère une ligne en fonction de la clef primaire
        $member = $memberRepo->find($id);

        //créer un formulaire de comment vide
        $comment = new Comment();

        //et le cible/associe
        $comment->setMember($member);

        $user = $this->getUser();

        //si l'utilisateur est connecté alors ont prend ses informations sinon non
        if($user == null)
        {

        }else{
            //créer un formulaire en lui associant notre comment vide
            $commentForm = $this->createForm(CommentType::class, $comment, ['user'=>$this->getUser()]);

            //prend les données envoyées et les injectent dans $comment
            $commentForm->handleRequest(($request));
        }

        //si le formulaire est soumis...
        if($commentForm->isSubmitted() && $commentForm->isValid()){


            //sauvegarde l'entité en base de données
            $em->persist($comment);
            $em->flush();

            //stocke un message en session pour affichage sur la page suivante
            $this->addFlash("success", "Your comment has been published!");
            //rediriger l'utilisateur ici-même pour vider le formulaire
            return $this->redirectToRoute('comment', ["id" => $id]);
        }

        return $this->render('tableau/comment.html.twig', [
            "member" => $member,
            "commentForm" => $commentForm->createView()
        ]);
    }
}
