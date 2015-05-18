<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\Validator\DI;

use Nette\DI\CompilerExtension;
use Symfony\Component\Validator\Validator;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\ValidatorBuilder;
use Symnedi\Validator\Caching\Cache;


class ValidatorExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('cache'))
			->setClass(Cache::class);

		$builder->addDefinition($this->prefix('validatorBuilder'))
			->setClass(ValidatorBuilder::class)
			->addSetup('enableAnnotationMapping')
			->addSetup('setMetadataCache');

		$builder->addDefinition($this->prefix('validator'))
			->setClass(RecursiveValidator::class)
			->setFactory(['@' . $this->prefix('validatorBuilder'), 'getValidator']);
	}

}
