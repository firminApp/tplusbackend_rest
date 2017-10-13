<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\apiSms;
use restB\restBundle\Entity\smsFromMaxiSms;
use restB\restBundle\Entity\verifCode;
use restB\restBundle\Form\Type\ApiSmsType;
use restB\restBundle\Form\Type\SmsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use restB\restBundle\Entity\userPocket;
use restB\restBundle\Form\Type\userPocketType;

use FOS\RestBundle\Controller\Annotations as Rest;

class MaxiSmsApiController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/apiparams")
     */

    public function getApiAction()
    {
        $api= $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:apiSms')
            ->findAll("true");


        return $api;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/apiparams")
     */
    public function crateApiAction(Request $request)
    {
        $apisms= new apiSms();
        $form = $this->createForm(ApiSmsType::class, $apisms);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($apisms);

            $em->flush();
            return $apisms;

        }
        else
            return $form;
    }

}