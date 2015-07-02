<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\Validator\DI;

use Doctrine\Common\Annotations\AnnotationReader;
use Nette\DI\CompilerExtension;
use Symfony\Component\Validator\Validator;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\ValidatorBuilder;
use Symnedi\Validator\Caching\Cache;


class ValidatorExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$containerBuilder = $this->getContainerBuilder();

		$containerBuilder->addDefinition($this->prefix('cache'))
			->setClass(Cache::class);

		$containerBuilder->addDefinition($this->prefix('validatorBuilder'))
			->setClass(ValidatorBuilder::class)
			->addSetup('setMetadataCache');

		$containerBuilder->addDefinition($this->prefix('validator'))
			->setClass(RecursiveValidator::class)
			->setFactory(['@' . $this->prefix('validatorBuilder'), 'getValidator']);
	}


	public function beforeCompile()
	{
		$annotationReaderName = $this->getNonAutowiredServiceNameByType(AnnotationReader::class);

		$containerBuilder = $this->getContainerBuilder();
		$containerBuilder->getDefinition($this->prefix('validatorBuilder'))
			->addSetup('enableAnnotationMapping', ['@' . $annotationReaderName]);
	}


	/**
	 * @param string $type
	 * @return string|NULL
	 */
	private function getNonAutowiredServiceNameByType($type)
	{
		$containerBuilder = $this->getContainerBuilder();
		foreach ($containerBuilder->findByType($type) as $name => $definition) {
			return $name;
		}
		return NULL;
	}

}
