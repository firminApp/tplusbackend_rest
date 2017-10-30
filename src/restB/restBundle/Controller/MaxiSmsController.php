<?php

namespace restB\restBundle\Controller;

use Proxies\__CG__\restB\restBundle\Entity\user;
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
use Csa\Bundle\GuzzleBundle;
use Unirest;
use FOS\RestBundle\Controller\Annotations as Rest;
use GuzzleHttp\Client;

class MaxiSmsController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Post("/sms/{senderPocket}/{passe}")
     */

    public function sendsmsAction(Request $request, $senderPocket, $passe)
    {
        $userpoket= $pocket = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->findOneBy(array('transactionPhone' => $senderPocket, 'pass' => $passe));

//si echec d'authentification
        if(empty($userpoket)){
            return new JsonResponse(["statut"=>"101","message"=>"echec d'authentification"]);
        }

        $sms= new smsFromMaxiSms();
        $form = $this->createForm(SmsType::class, $sms);


        $form->submit($request->request->all()); // Validation des données

       if(!$form->isValid())
           return new JsonResponse(["statut"=>"110","message"=>"echec: données incorrectes"]);

        $from=$sms->getFrom();
        $to=$sms->getTo();
        $body=$sms->getBody();
        //taille du message envoyé
        $nombr=strlen($body)/160>1?ceil(strlen($body)/160):1;
        $nombrdesti=strlen($to)/9>1?ceil(strlen($to)/9):1;
        //a t'il suiffisament de sout?
        if ($userpoket->getSolde()<$nombr*45)
        {
            return new JsonResponse(["statut"=>"111","message"=>"Solde insuiffisant"]);

        }
        $sms->setCouttotal($nombr);
        $sms->setDatesend(date_format(date_create(),"Y-m-d H:i:s"));//date_format()
        $sms->setPocketsender($senderPocket);


        //defalcation et mse a jour du solde
        $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:userPocket')
            ->resetSolde($senderPocket,$userpoket->getSolde()-$nombr*45*$nombrdesti);

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&api=6928&h=f33ce5817bd8269e14f0d7f8a728fe30&from='.$from.'&to='.$to.'&text='.$body);

           // $sms->setSendresponse($res->getBody());
            $this->savedSms($sms);
            return new JsonResponse(["statut"=>"1011","message"=>"Effectué","apirep"=>$res->getBody()]);//$this->redirect("http://74.207.224.67/api/http/sendmsg.php?user=benjamin&password=1992nabine&api=6928&h=f33ce5817bd8269e14f0d7f8a728fe30&from=$from&to=$to&text=$body");

         }


    public function savedSms(smsFromMaxiSms $sms)
    {
        //$form = $this->createForm(SmsType::class, $sms);

        //$form->submit($request->request->all()); // Validation des données

       // if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($sms);
            //generation du code de verification associer
            $em->flush();
            //return new JsonResponse(['statut' => 'succes']);
       // }

    }
    /**
     *  @Rest\View()
     * @Rest\Get("/sms")
     */

    public function getAllUsersSmsAction()
    {
        $sms = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:smsFromMaxiSms')
            ->findAll();

        return $sms;
    }

    
}