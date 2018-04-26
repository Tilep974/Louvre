<?php

namespace OC\BillingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\BillingBundle\Form\TicketOrderType;
use OC\BillingBundle\Entity\TicketOrder;
use OC\BillingBundle\Form\TicketType;
use OC\BillingBundle\Entity\Ticket;

class BillingController extends Controller
{
	public function indexAction()
	{
		$order = new TicketOrder();
		$ticket = new Ticket();
		
		$orderForm =$this->get('form.factory')->createNamed('orderForm', TicketOrderType::class, $order);
		$ticketForm = $this->get('form.factory')->createNamed('ticketForm', TicketType::class, $ticket)
		
		return $this->render('OCBillingBundle:Billing:index.html.twig', array(
			'orderForm' => $orderForm->createView();
			'ticketForm' => $ticketForm->createView(),
		));
	}
}