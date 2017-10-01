<?php

namespace restB\restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use restB\restBundle\Entity\userPocket;
use restB\restBundle\Form\Type\userPocketType;

use FOS\RestBundle\Controller\Annotations as Rest;

class VerifCodeController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/codeverif")
     */

    public function getAllAction()
    {
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:verifCode')
            ->findAll();


        return $users;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/verifcode/{id}")
     */
    public function getcodeAction($id, Request $request)
    {

        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:verifCode')
            ->find($id); // L'identifiant est utilisé directement
        if (empty($user)) {
            return new JsonResponse(['statut' => 'code not found'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/verifcode/{id}")
     */
    public function newcodeAction($id,Request $request)
    {
         $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('restBundle:verifCode')
                ->find($id);
      

        if (empty($user)) {
            return $this->UserNotFound();
        }
        
        $code= new verifCode();
        $code->setUser($code);
        $form = $this->createForm(VerifCodeType::class, $code);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($code);
            $em->flush();
            return $code;
        } else {
            return $form;
        }
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/verifcode/{id}")
     */
    public function removeAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $pocket = $em->getRepository('restBundle:verifCode')
            ->find($request->get('id'));
        /* @var $place Place */
if($pocket){
        $em->remove($pocket);
        $em->flush();
    }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/verifcode/{id}")
     */
    public function updatcodeAction(Request $request)
    {
        return $this->updatePocket($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/verifcode/{id}")
     */
    public function patchUserPocketAction(Request $request)
    {
        return $this->updatePocket($request, false);
    }


      /**
     * @Rest\View()
     * @Rest\Post("/verify")
     */
    public function verifyAction(Request $request)
    {
        $tphone=$request->get("tphone");
        $code=$request->get("code");

        $cverif = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:verifCode')
            ->findBy( array("tel"=>$tphone, "code"=>$code));
        if (empty($cverif)) {
            return new JsonResponse(['statut' => 'echec'], Response::HTTP_NOT_FOUND);
        }  else {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($cverif);
            $em->flush();
          //  patch($request, false);
            return new JsonResponse(['statut' => 'succes']);
            
        }

        return $cverif;
    }
    
}