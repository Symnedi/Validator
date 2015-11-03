<?php

namespace Symnedi\Validator\Tests\ValidatorSource;

use Symfony\Component\Validator\Constraints as Assert;


class SomeEntity
{

	/**
	 * @Assert\NotBlank
	 * @var string
	 */
	private $name;

	/**
	 * @Assert\NotBlank
	 * @Assert\Email
	 * @var string
	 */
	private $email;

}
