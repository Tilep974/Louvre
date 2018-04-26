<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
	public function indexAction()
	{
		return $this->render('OCPlatformBundle:Advert:index.html.twig');
	}
	
	public function legalAction()
	{
		return $this->render('OCPlatformBundle:Advert:legal.html.twig');
	}
	
	public function termsAction()
	{
		return $this->render('OCPlatformBundle:Advert:terms.html.twig');
	}
}
