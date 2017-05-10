<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageController extends Controller
{
    /**
    * @Route("/", name="index")
    */
    public function indexAction()
    {
        $requests = $this->getDoctrine()->getRepository('AppBundle:Request')->findAll();

        return $this->render('request/index.html.twig', array('requests'=>$requests));
    }
    /**
     * @Route("/request/create", name="create")
     */
    public function createAction(Request $request)
    {
        $r = new Request;
        $form=$this->createFormBuilder($testing)->add('request', TextType::class, array('attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))->add('categories', EntityType::class, array('class'=>'AppBundle:Category',
        'choice_label'=> 'username',
        'multiple' => true,
        'expanded' => true),
        'attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $req=$form['request']->getData();
            $r->setRequest($req);

            $em=$this->getDoctrine()->getManager();

            $em->persist($r);
            $em->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('request/create.html.twig', array('form'=>$form->createView()));
    }
}
