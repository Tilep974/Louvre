<?php

namespace OC\BillingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionResolver;
use Symfony\Component\Form\Extention\Core\Type\TextType;
use Symfony\Component\Form\Extention\Core\Type\DateType;
use Symfony\Component\Form\Extention\Core\Type\CountryType;
use Symfony\Component\Form\Extention\Core\Type\CheckboxType;

class TicketType extends AbstractType
{
	/**
	* {@inheritdoc}
	*/
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('firstName', TextType::class, array(
					'label' => 'First name'
				))
				->add('name', TextType::class, array(
					'label' => 'Name'
				))
				->add('country', CountryType::class, array(
					'label' => 'Country',
					'placeholder' => 'Choose a country...',
					'preferred_choices' => array('FR', 'GB', 'US', 'CN' )
				))
				->add('birthDate', DateType::class, array(
					'invalid_message' => "Birth date must be either a valid Datetime object or a valid date string.",
					'widget' => 'single_text',
					'html5' => false,
					'label' => 'Birth date'
				))
				->add('discounted', CheckboxType::class, array(
					'label' => 'Reduced price'
				));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsREsolver $resolver)
	{
		$resolver->setDefaults(array(
			'date_class' => 'OC\BillingBundle\entity\Ticket'
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return'oc_platformbundle_ticket';
	}
}