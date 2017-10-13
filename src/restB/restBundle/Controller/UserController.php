<?php

namespace restB\restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use restB\restBundle\Entity\user;
use restB\restBundle\Form\Type\UserType;

use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/users")
     */

    public function getAllUsersAction()
    {
        $users = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:user')
            ->findAll();

        return $users;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/users/{id}")
     */
    public function getUserAction($id, Request $request)
    {
        $formatted = [];
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:user')
            ->find($id); // L'identifiant est utilisé directement
        if (empty($user)) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/users")
     */
    public function postUserAction(Request $request)
    {
        $user= new User();
        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($user);

            $em->flush();
            $codeverif = $this->generateCode();

              //  echo $apiresponse;
                return new JsonResponse(['statut' => "succes", 'code' => $codeverif]);

            }
            else
                return new JsonResponse(['statut' => "echec"]);

    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/users/{id}")
     */
    public function removeUserAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $user = $em->getRepository('restBundle:user')
            ->find($request->get('id'));
        /* @var $place Place */
if($user){
        $em->remove($user);
        $em->flush();
    }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/users/{id}")
     */
    public function updateUserAction(Request $request)
    {
        return $this->updateUser($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/users/{id}")
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateUser($request, false);
    }

    private function updateUser(Request $request, $clearMissing)
    {
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:user')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $place Place */
       // echo $request->get('id');

        if (empty( $user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(UserType::class,  $user);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $user);
            $em->flush();
            return  $user;
        } else {
            return $form;
        }
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
     *  @Rest\View()
     * @Rest\Get("/api")
     */
    function  sendCodeBySms($code, $tel){
       // header("Location: http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&from=Maxi sms&to=$tel&text=$code est votre code de vérification.&api=6928");

        //$sender="http://74.207.224.67/api/http/sendsms.php?user=benjamin&password=1992nabine&from=Maxi sms&text=".$code."&to=".$tel."&api=6828";
        return $this->redirect("http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&from=Maxi sms&to=$tel&text=$code est votre code de vérification.&api=6928");

    }
    function Sendsms($codeh,$tel){
        header("Location: http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&from=Maxi sms&to=$tel&text=$codeh est votre code de vérification.&api=6928");
        //return print "Message bien envoyer au $tel";

    }
}