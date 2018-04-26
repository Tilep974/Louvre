<?php

namespace OC\BillingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extention\Core\Type\DateType;
use Symfony\Component\Form\Extention\Core\Type\ChoiceType;
use Symfony\Component\Form\Extention\Core\Type\IntegerType;

class TicketOrderType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('date', DateType::class, array(
					'invalid_message' => "Order date must be either a valid DateTime object or a valid date string.",
					'widget' => 'single_text',
					'html5' => false,
					'label' => 'Date of the visit'
				))
				->add('type', ChoiceType::class, array(
					'label' => 'Ticket type',
					'choices' => array(
						'Full-day' => 1,
						'Half-Day' => 0,
					),
					'expanded' => true,
					'multiple' => false,
				))
				->add('nbTickets', IntegerType::class, array(
					'invalid_message' => "The number of tickets in the order must be a valid integer greater than 0.",
					'label' => "Tickets count"
				));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function conbfigureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'OC\BillingBundle\Entity\TicketOrder'
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'oc_platformbundle_ticketorder';
	}
}