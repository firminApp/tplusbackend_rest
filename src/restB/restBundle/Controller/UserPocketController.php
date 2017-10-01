<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\verifCode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use restB\restBundle\Entity\userPocket;
use restB\restBundle\Form\Type\userPocketType;

use FOS\RestBundle\Controller\Annotations as Rest;

class UserPocketController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/pocket")
     */

    public function getAllUserPocketAction()
    {
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findAll();


        return $users;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/pocket/{id}")
     */
    public function getUserPocketAction($id, Request $request)
    {

        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->find($id); // L'identifiant est utilisé directement
        if (empty($user)) {
            return new JsonResponse(['message' => 'Pocket not found'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/pocket/{iduser}")
     */
    public function newPocketAction($iduser,Request $request)
    {
         $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('restBundle:user')
                ->find($iduser);


        if (empty($user)) {
            return $this->UserNotFound();
        }

        $pocket= new userPocket();
        $pocket->setUser($user);
        $form = $this->createForm(UserPocketType::class, $pocket);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($pocket);
            //generation du code de verification associer
            $em->flush();
            return $pocket;
        } else {
            return $form;
        }
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/pocket/{id}")
     */
    public function removeUserPocketAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $pocket = $em->getRepository('restBundle:userPocket')
            ->find($request->get('id'));
        /* @var $place Place */
if($pocket){
        $em->remove($pocket);
        $em->flush();
    }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/pocket/{id}")
     */
    public function updateUserPocketAction(Request $request)
    {
        return $this->updatePocket($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/pocket/{id}")
     */
    public function patchUserPocketAction(Request $request)
    {
        return $this->updatePocket($request, false);
    }

    private function updatePocket(Request $request, $clearMissing)
    {
        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $place Place */
       // echo $request->get('id');

        if (empty( $pocket)) {
            return new JsonResponse(['message' => 'Pocket not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(userPocketType::class,  $pocket);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $pocket);
            $em->flush();
            return  $pocket;
        } else {
            return $form;
        }
    }
     /**
     * @Rest\View()
     * @Rest\Get("/conpocket/{tphone}")
     */
    public function conneexionTopocketAction($tphone,Request $request)
    {

        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findByTransactionPhone( $tphone);
        if (empty($user)) {
            return new JsonResponse(['message' => 'Données inccorectes!'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
      /**
     * @Rest\View()
     * @Rest\Post("/crediter")
     */
    public function crediterCompteAction(Request $request)
    {
        $tphone=$request->get("tphone");
        $montant=$request->get("montant");

        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findByTransactionPhone( $tphone);
        if (empty($pocket)) {
            return new JsonResponse(['message' => 'Données inccorectes!'], Response::HTTP_NOT_FOUND);
        }  else {
           
            
          //  patch($request, false);
            return new JsonResponse(['message' => 'Compte rechargé. nouveau solde= '.$montant.' encien solde= '.$pocket-->get("solde")]);
            
        }

        return $pocket;
    }
    
}