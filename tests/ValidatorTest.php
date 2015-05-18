<?php

namespace Symnedi\Validator\Tests;

use Symnedi\Validator\Tests\ValidatorSource\SomeEntity;
use Nette\DI\Container;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ValidatorTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @var ValidatorInterface
	 */
	private $validator;


	public function __construct()
	{
		$this->container = (new ContainerFactory)->create();
	}


	protected function setUp()
	{
		$this->validator = $this->container->getByType(ValidatorInterface::class);
	}


	public function testContainerRegistration()
	{
		$this->assertInstanceOf(RecursiveValidator::class, $this->validator);
	}


	public function testValidation()
	{
		$violations = $this->validator->validate(new SomeEntity);
		$this->assertCount(2, $violations);
		$this->assertInstanceOf(ConstraintViolationList::class, $violations);

		$violation = $violations[0];
		$this->assertInstanceOf(ConstraintViolation::class, $violation);
		$this->assertSame('This value should not be blank.', $violation->getMessage());

		$violation = $violations[1];
		$this->assertInstanceOf(ConstraintViolation::class, $violation);
		$this->assertSame('This value should not be blank.', $violation->getMessage());
	}

}
