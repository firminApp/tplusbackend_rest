<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\appRouter;
use restB\restBundle\Form\Type\appRouterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations as Rest;

class AppRouterController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/approuter")
     */

    public function getUsersAction()
    {
        $app = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:appRouter')
            ->findAll();

        return $app;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/approuter/{id}")
     */
    public function getapprouterAction($id, Request $request)
    {
        $formatted = [];
        $user = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:appRouter')
            ->find($id); // L'identifiant est utilisé directement
        if (empty($user)) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/getapp/{token}")
     */
    public function getByTokenAction($token)
    {
        $formatted = [];
        $app = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:appRouter')
            ->findOneByToken($token); // L'identifiant est utilisé directement
        if (empty($app)) {
            return new JsonResponse(['message' => 'Appli non  non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $app;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/approuter")
     */
    public function postAppAction(Request $request)
    {
        $app= new appRouter();
        $form = $this->createForm(appRouterType::class, $app);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($app);
            $em->flush();
            return $app;
        } else {
            return $form;
        }
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/approuter/{id}")
     */
    public function removeapprAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $app = $em->getRepository('restBundle:appRouter')
            ->find($request->get('id'));
if($app){
        $em->remove($app);
        $em->flush();
    }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/approuter/{id}")
     */
    public function updateAppAction(Request $request)
    {
        return $this->updateApp($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/approuter/{id}")
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateApp($request, false);
    }

    private function updateApp(Request $request, $clearMissing)
    {
        $app = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:appRouter')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $place Place */
       // echo $request->get('id');

        if (empty( $app)) {
            return new JsonResponse(['message' => 'App not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(appRouterType::class,  $app);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $app);
            $em->flush();
            return  $app;
        } else {
            return $form;
        }
    }
}