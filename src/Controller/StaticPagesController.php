<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class StaticPagesController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('static_pages/index.html.twig');
    }


    /**
     *  @Route("/réalisations", name="app_real")
     */
    public function real()
    {
    	return $this->render('static_pages/réalisation.html.twig');
    }

    /**
     *  @Route("/contact", name="app_contact", methods={"GET", "POST"})
     */
    public function contact(Request $request)
    {

    	$form = $this->createFormBuilder()
    		->add('name', TextType::class, [
    				'label' => 'Nom :'
    			]
    		)
    		->add('firstName', TextType::class, [
    				'label' => 'Prénom :'
    			]
    		)
    		->add('mail', TextType::class, [
    				'label' => 'Courriel :'
    			]
    		)
    		->add('phone', TextType::class, [
    				'label' => 'Téléphone :'
    			]
    		)
    		->add('function', TextType::class, [
    				'label' => 'Fonction :'
    			]
    		)
    		->add('society', TextType::class, [
    				'label' => 'Société :'
    			]
    		)
    		->add('subject', ChoiceType::class, [
    				'label' => 'Motif :',
    				'choices' => [
    					'demande de devis' => 'devis',
    					'demande de contact' => 'contact'
    				]
    			]
    		)
    		->add('message', TextareaType::class, [
    				'label' => 'Message :'
    			]
    		)
    		->add('agreement', CheckboxType::class, [
    				'label' => "En soumettant ce formulaire, j'accepte que les informations saisies soient exploitées dans le cadre d'une relation commerciale qui pourrait en découler."
    			]
    		)
    		->getForm()
    	;

    	$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$data = $form->getData();

			$lastName = $data['name'];
	
			$firstName = $data['firstName'];
	
			$function = $data['function'];
			if (empty($function)) {
			  	$function = 'vide';
			  }
	
			$society = $data['society'];
			if (empty($society)) {
			  	$society = 'vide';
			  }
	
			$agreement = $data['agreement'];
	
			$mail = $data['mail'];
	
			$phone = $data['phone'];
	
			$message = $data['message'];

			$motif = $data['subject'];

			$body = "Nom = $lastName \r\n";
			$body .= "Prénom = $firstName \r\n";
			$body .= "Fonction = $function \r\n";
			$body .= "Société = $society \r\n";
			$body .= "Courriel = $mail \r\n";
			$body .= "Téléphone = $phone \r\n";
			$body .= "Motif = $motif \r\n";
			$body .= "Message = $message \r\n";

			$email = (new Email())
				->from('dockangoo@gmail.com')
				->to('marc@larrun-prod.com')
				->subject('Demande de contact depuis le site')
				->text($body)
			;

			return $this->redirectToRoute('app_home');

		}






    	return $this->render('static_pages/contact.html.twig', [
    		'form' => $form->createView()
    	]);
    }
}
