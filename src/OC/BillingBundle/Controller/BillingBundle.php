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
	public function indexAction(Request $request)
	{
		$order = new TicketOrder();
		$ticket = new Ticket();
		// step we're currently at
		$step = 0;
		
		$orderForm =$this->get('form.factory')->createNamed('orderForm', TicketOrderType::class, $order);
		$ticketForm = $this->get('form.factory')->createNamed('ticketForm', TicketType::class, $ticket)
		
		if('POST' === $request->getMethod()) {
			if ($request->request->has($orderForm->getName())) {
				$orderForm->submit($request->request->get($orderForm->getName()), false);
				if ($orderForm->isValid()) {
					$step = 1;
					
					$orderForm = $this-get('form.factory')->cretaNamed('orderForm', TicketOrderType::class, $order);
				}
				
				if ($request->request->has($ticketForm->getName())) {
					$ticketForm->submit($request->request->get($ticketForm->getName()), false
		return $this->render('OCBillingBundle:Billing:index.html.twig', array(
			'orderForm' => $orderForm->createView();
			'ticketForm' => $ticketForm->createView(),
		));
	}
			}