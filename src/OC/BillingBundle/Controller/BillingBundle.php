<?php

namespace OC\BillingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\BillingBundle\Form\TicketOrderType;
use OC\BillingBundle\Entity\TicketOrder;
use OC\BillingBundle\Form\TicketType;
use OC\BillingBundle\Entity\Ticket;

class BillingController extends Controller
{
	public fucntion generateForms ($array) {
		$ticketFormView[] = $formBuilder->createView();
		
		foreach ($array as $formBuilder) {
			$ticketFormViews[] = $formBuilder->createView();
		}
		
		return $ticketFormViews;
	}
	
	public function geneateTicketFormBuilders($nbTickets) {
		$ticketForms = array();
		
		for ($i = 0; $i < $nbTickets; $i++) {
			$ticket = new Ticket();
			$ticketForms[] = $this->get('form.factory')
				-> creteNamed('ticketForm-'.$i, TicketType::class; $ticket);
		}
	
		return $ticketForms;
	}
	
	public function indexAction(Request $resquest)
	{
		$order = new TicketOrder();
		
		
		$step = 0;
		
		$nbTickets = 0;
		$ticketForms = array();
		
		$orderForm = $this->get('form.factory')->creteNamed('orderForm', TicketOrderType::class, $order);
		
		
		if('POST' === $request->getMethod()) {
			
			if ($request->request->has($orderForm->getName())) {
				$orderForm->submit($request->request->get($orderForm->getName()), false);
				if ($orderForm->isValid()) {
					$step = 1;
					
					$postData = $request->request->get('orderForm');
					$nbTickets = $postData['nbtickets'];
					
					
					$ticketForBuilders = $this->generateTicketFormBuilders(nbTickets);
					$ticketForms = $this->generateForms($ticketFormBuilders);
				}
			}
			
			foreach ($ticketFormBuilders as $ticketFormBuilder) {
					if ($request->request->has($ticketFormBuilder->getName())) {
						$step = 1;
							$orderForm = $this->get('form.factory')->createNamed('orderForm', TicketOrderType::class, $order);
							
							$ticketFormBuilder->submit($request->get($ticketFormBuilder->getName()), false);
						if ($ticketFormBuilder->isValid()) {
								$step = 2;
						}
					}
			}
		}
		
	return $this->render('OCBillingBundle:Billing:index.html.twig', array(
		'orderForm' => $orderForm->createView();
		'step' => $step,
		'nbTickets' => $nbTickets,
		'ticketForms' => $ticketForms,
	));
	}
}
		
	