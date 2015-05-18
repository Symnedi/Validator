<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\Validator\Tests\DI;

use Nette\DI\Compiler;
use Nette\DI\ContainerBuilder;
use PHPUnit_Framework_TestCase;
use Symnedi\Validator\DI\ValidatorExtension;


class ValidatorExtensionTest extends PHPUnit_Framework_TestCase
{

	public function testContainerValidator()
	{
		$extension = $this->getExtension();
		$extension->loadConfiguration();
	}


	/**
	 * @return ValidatorExtension
	 */
	private function getExtension()
	{
		$extension = new ValidatorExtension;
		$extension->setCompiler(new Compiler(new ContainerBuilder), 'compiler');
		return $extension;
	}

}
