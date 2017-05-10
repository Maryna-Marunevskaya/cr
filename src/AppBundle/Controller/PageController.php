<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Enquiry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageController extends Controller
{
    /**
    * @Route("/index", name="index")
    */
    public function indexAction()
    {
        $enquiries = $this->getDoctrine()->getRepository('AppBundle:Enquiry')->findAll();

        return $this->render('enquiry/index.html.twig', array('enquiries'=>$enquiries));
    }
    /**
     * @Route("/enquiry/create", name="create")
     */
    public function createAction(Request $request)
    {
        $enquiry = new Enquiry;
        $form=$this->createFormBuilder($enquiry)->add('enquiry', TextareaType::class, array('label'=>'Запрос','attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))->add('categories', EntityType::class, array('label'=>'Выберите категорию или категории','class' =>'AppBundle:Category','choice_label' => 'category','multiple' => true,'expanded' => true
))->add('save', SubmitType::class, array('label'=>'Добавить запрос','attr'=>array('class'=>'btn btn-primary', 'style'=>'margin-bottom:15px')))->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $req=$form['enquiry']->getData();
            $enquiry->setEnquiry($req);

            $em=$this->getDoctrine()->getManager();

            $em->persist($enquiry);
            $em->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('enquiry/create.html.twig', array('form'=>$form->createView()));
    }
}
