<?php

namespace restB\restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restB\restBundle\Entity\Place;
use FOS\RestBundle\Controller\Annotations as Rest;
use restB\restBundle\Form\Type\PlaceType;
use FOS\RestBundle\View\View;

class PlaceController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/places")
     */
    public function getPlacesAction()
    {
        $places = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:Place')
            ->findAll();


        // Récupération du view handler
        //$viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
       // $view = View::create($places);
       // $view->setFormat('json');

        // Gestion de la réponse
        //return $viewHandler->handle($view);
        return $places;
    }

    /**
     *  @Rest\View()
     * @Rest\Get("/places/{id}")
     */
    public function getPlaceAction($id, Request $request)
    {
        $formatted = [];
        $place = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:Place')
            ->find($id); // L'identifiant est utilisé directement


        //$viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
       // $view = View::create($place);
       // $view->setFormat('json');

        // Gestion de la réponse
       // return $viewHandler->handle($view);
        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }
        return $place;
    }
    /**
     *  @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/place")
     */
    public function createPlaceAction(Request $request)
    {
        $place=new Place();
        $place->setName($request->get("name"));
        $place->setAddress($request->get("address"));

        $em=$this->get('doctrine.orm.entity_manager');
        $em->persist($place);
        $em->flush();
        return $place;

    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places")
     */
    public function postPlacesAction(Request $request)
    {
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($place);
            $em->flush();
            return $place;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/places/{id}")
     */
    public function removePlaceAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $place = $em->getRepository('restBundle:Place')
            ->find($request->get('id'));
        /* @var $place Place */
if($place){
        $em->remove($place);
        $em->flush();
    }
    }
    //mise a jour partielle

    /**
     * @Rest\View()
     * @Rest\Put("/places/{id}")
     */
    public function updatePlaceAction(Request $request)
    {
        return $this->updatePlace($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/places/{id}")
     */
    public function patchPlaceAction(Request $request)
    {
        return $this->updatePlace($request, false);
    }

    private function updatePlace(Request $request, $clearMissing)
    {
        $place = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:Place')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $place Place */

        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PlaceType::class, $place);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($place);
            $em->flush();
            return $place;
        } else {
            return $form;
        }
    }

}