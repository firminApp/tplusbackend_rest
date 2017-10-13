<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\user;
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
     * @Rest\Post("/pocket")
     */
    public function newPocketAction(Request $request)
    {
        $check=$this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findOneByTransactionPhone($request->get("tel"));
        if (empty(!$check)) {
            return new JsonResponse(['statut' => 'inscrit']);
        }
        $user=new user();
        $user->setTel($request->get("tel"));
        $user->setEmail($request->get("mail"));
        $user->setFirstname($request->get("pseudo"));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($user);
        /* $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('restBundle:user')
                ->find($iduser);


        if (empty($user)) {
            return new JsonResponse(['message' => 'User innexistant!'], Response::HTTP_NOT_FOUND);

        }
*/
        $pocket= new userPocket();
        $pocket->setIsOneline(true);
        $pocket->setUser($user);
        $pocket->setAccountNumber($request->get("tel"));
        $pocket->setTransactionPhone($request->get("tel"));
        $pocket->setPass($request->get("pass"));
        $pocket->setSolde("0");
       /* $form = $this->createForm(UserPocketType::class, $pocket);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {*/
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($pocket);
            //generation du code de verification associer
            $em->flush();
        return new JsonResponse(['statut' => 'succes','code' => $this->generateCode()]);
       /* } else {
            return $form;
        }*/
    }

    function generateCode($length = 6) {
        $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
     * @Rest\Get("/crediter/{tphone}")
     */
    public function crediterCompteAction($tphone)
    {
        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findByTransactionPhone( $tphone);

        if (empty($pocket)) {
            return new JsonResponse(['message' => 'Données inccorectes!'], Response::HTTP_NOT_FOUND);
        }  else {

            $this->get('doctrine.orm.entity_manager')
                ->getRepository('restBundle:userPocket')
                ->resetSolde($tphone, 33000);
          //  patch($request, false);
            return new JsonResponse(['message' => 'Compte rechargé']);
            
        }

        return $pocket;
    }
    /**
     * @Rest\View()
     * @Rest\Post("/solde")
     */
    public function getSoldeAction(Request $request)
    {
        $tphone=$request->get("tphone");
        $pass=$request->get("pass");

        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findBy( array('transactionPhone'=>$tphone,'pass'=>$pass));
        if (empty($pocket)) {
            return new JsonResponse(['message' => 'Données inccorectes!'], Response::HTTP_NOT_FOUND);
        }  else {


            //  patch($request, false);
            return new JsonResponse(['statut' => 'succes','solde' => $pocket->getSolde()]);

        }

    }

    /**
     * @Rest\View()
     * @Rest\Get("/solde/{tel}/{passe}")
     */
    public function getPocketSoldeAction($tel,$passe)
    {

        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findOneBy(array('transactionPhone' => $tel, 'pass' => $passe));
        if (empty($pocket)) {
            return new JsonResponse(['message' => 'Compte innexistant'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(['solde' => $pocket->getSolde()]);

        //return $pocket;//->getSolde();
    }

    /**
     * @Rest\View()
     * @Rest\Get("/connexion/{tel}/{passe}")
     */
    public function connexionAction($tel,$passe)
    {

        $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findOneBy(array('transactionPhone' => $tel, 'pass' => $passe));
        //if (empty($pocket)) {
        //    return new JsonResponse(['message' => 'echec'], Response::HTTP_NOT_FOUND);
        //}
        /*elseif ($pocket ->getIsOneline())
        {
            return new JsonResponse(['statut' => "Ce compte est en cours d'usage"]);
        }*/
        $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->resetConnexionStatut($tel,true);


        return new JsonResponse(['statut' => 'succes']);

        //return $pocket;//->getSolde();
    }
    public function resetSolde(userPocket $poket,$value){


        $poket->setSolde($poket->getSolde()+$value);
        if (empty( $pocket)) {
            return new JsonResponse(['message' => 'Pocket not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(userPocketType::class,  $pocket);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $pocket);
            $em->flush();
            return  $pocket;
        } else {
            return $form;
        }

    }
    public function resetOnlineStatut(userPocket $poket,$value){


    }

}