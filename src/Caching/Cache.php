<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\Validator\Caching;

use Nette\Caching\Cache AS NetteCache;
use Nette\Caching\IStorage;
use Symfony\Component\Validator\Mapping\Cache\CacheInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;


final class Cache implements CacheInterface
{

	/**
	 * @var string
	 */
	const CACHE_NAMESPACE = 'Symfony.Validator';

	/**
	 * @var NetteCache
	 */
	private $cache;


	/**
	 * @param IStorage $storage
	 * @param string $namespace
	 */
	public function __construct(IStorage $storage, $namespace = self::CACHE_NAMESPACE)
	{
		$this->cache = new NetteCache($storage, $namespace);
	}


	/**
	 * {@inheritdoc}
	 */
	public function has($class)
	{
		return $this->cache->load($class) !== NULL;
	}


	/**
	 * {@inheritdoc}
	 */
	public function read($class)
	{
		return $this->has($class) ? $this->cache->load($class) : FALSE;
	}


	/**
	 * {@inheritdoc}
	 */
	public function write(ClassMetadata $metadata)
	{
		$this->cache->save($metadata->getClassName(), $metadata);
	}

}
