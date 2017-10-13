<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\smsFromMaxiSms;
use restB\restBundle\Entity\verifCode;
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

class MaxiSmsController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/send")
     */

    public function sendsmsAction(Request $request)
    {
        $sms= new smsFromMaxiSms();
        $form = $this->createForm(SmsType::class, $sms);

        $form->submit($request->request->all()); // Validation des données

       if(!$form->isValid())
           return new JsonResponse(["statut"=>"echec: données incorrectes"]);
        $this->savedSms($sms);

        return $this->redirect("http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&from=$from&to=$to&text=$body&api=6928");

    }



    public function savedSms($sms)
    {
        $form = $this->createForm(SmsType::class, $sms);

        //$form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($sms);
            //generation du code de verification associer
            $em->flush();
            //return new JsonResponse(['statut' => 'succes']);
        }

    }

    
}