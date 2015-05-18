<?php

namespace Symnedi\Validator\Tests\ValidatorSource;

use Symfony\Component\Validator\Constraints as Assert;


class SomeEntity
{

	/**
	 * @Assert\NotBlank
	 */
	private $name;

	/**
	 * @Assert\NotBlank
	 * @Assert\Email
	 */
	private $email;

}
