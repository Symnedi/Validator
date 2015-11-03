# Symnedi/Validator

[![Build Status](https://img.shields.io/travis/Symnedi/Validator.svg?style=flat-square)](https://travis-ci.org/Symnedi/Validator)
[![Quality Score](https://img.shields.io/scrutinizer/g/Symnedi/Validator.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/Validator)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Symnedi/Validator.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/Validator)
[![Downloads](https://img.shields.io/packagist/dt/symnedi/validator.svg?style=flat-square)](https://packagist.org/packages/symnedi/validator)
[![Latest stable](https://img.shields.io/packagist/v/symnedi/validator.svg?style=flat-square)](https://packagist.org/packages/symnedi/validator)


## Install

Via Composer:

```sh
$ composer require symnedi/validator
```

Register the extension in `config.neon`:

```yaml
extensions:
	- Symnedi\Validator\DI\ValidatorExtension
	- Kdyby\Annotations\DI\AnnotationsExtension
```


## Usage

Let's register user, but only while having valid email.

First, use validation annotations on entity (object) you want to validate.


```php
use Symfony\Component\Validator\Constraints as Assert;


class User
{

	/**
	 * @Assert\NotBlank
	 * @Assert\Email
	 */
	private $email;


	/**
	 * @var string $email
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}

}
```


Then validate in our service:

```php
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationManager
{

	/**
	 * @var ValidatorInterface
	 */
	private $validator;


	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}


	/**
	 * Instance is passed: $user = new User('invalid.email');
	 */
	public function registerUser(User $user)
	{
		$violations = $this->validator->validate($user);

		// process violations
		$violation = $violations[0];
		$violation->getMessage(); // 'Email is not valid.'
	}

}
```

That's it!

For detailed usage, check [Symfony documentation](http://symfony.com/doc/current/book/validation.html).


## Testing

```sh
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
