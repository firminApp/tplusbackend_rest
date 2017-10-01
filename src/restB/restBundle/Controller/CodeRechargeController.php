<?php

namespace restB\restBundle\Controller;

use restB\restBundle\Entity\codeRecharge;
use restB\restBundle\Form\Type\codeRechargeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use restB\restBundle\Form\Type\UserType;

use FOS\RestBundle\Controller\Annotations as Rest;

class CodeRechargeController extends Controller
{
    /**
     *  @Rest\View()
     * @Rest\Get("/recharge")
     */

    public function getCodeRechargeAction()
    {
        $code= $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:codeRecharge')
            ->findAll();

        return $code;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/recharge/{id}")
     */
    public function getRechargeAction($id, Request $request)
    {
        $formatted = [];
        $code = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:codeRecharge')
            ->find($id); // L'identifiant est utilisé directement
        if (empty($code)) {
            return new JsonResponse(['message' => 'Recharge non trouvée'], Response::HTTP_NOT_FOUND);
        }
        $this->updateRecharge($request,false);

        return $code;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/recharge")
     */
    public function posteRechargeAction(Request $request)
    {
        $code= new codeRecharge();
        $form = $this->createForm(codeRechargeType::class, $code);

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
     * @Rest\Delete("/recharge/{id}")
     */
    public function removeCodeRechargeAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $code = $em->getRepository('restBundle:codeRecharge')
            ->find($request->get('id'));
        /* @var $place Place */
if($code){
        $em->remove($code);
        $em->flush();
    }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/recharge/{id}")
     */
    public function updateRechargeAction(Request $request)
    {
        return $this->updateRecharge($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/recharge/{id}")
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateRecharge($request, false);
    }
    /**
     * @Rest\View()
     * @Rest\Patch("/recharge/{code}")
     */
    public function patchRechargeAction($code,Request $request)
    {
        $code = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:codeRecharge')
            ->findOneByCode($code);
        if (empty( $code)) {
            return new JsonResponse(['message' => 'Recharge non trouvée'], Response::HTTP_NOT_FOUND);
        }
        $code->setDestinataire("livré");

        $form = $this->createForm(CodeRechargeType::class,  $code);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $code);
            $em->flush();
            return new JsonResponse(['message' => 'Code recharge mise à jour']);
        } else {
            return $form;
        }
    }


    private function updateRecharge(Request $request, $clearMissing)
    {
        $code = $this->get('doctrine.orm.entity_manager')
            ->getRepository('restBundle:codeRecharge')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $place Place */
       // echo $request->get('id');

        if (empty( $code)) {
            return new JsonResponse(['message' => 'Recharge non trouvée'], Response::HTTP_NOT_FOUND);
        }
        $code->setIsUsed(true);
        $form = $this->createForm(CodeRechargeType::class,  $code);

        // Le paramètre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist( $code);
            $em->flush();
            return  $code;
        } else {
            return $form;
        }
    }
}