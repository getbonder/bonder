<?php

namespace Bonder\Object;

/**
 * Chains object providers.
 * 
 * @author hbandura
 */
final class ProviderChain implements \Bonder\Object\ObjectProvider {
  
  /**
   * @var \Bonder\Object\ObjectProvider[]
   */
  private $providers;
  
  /**
   * Creates a new ProviderChain with the providers given.
   * 
   * @param \Bonder\Object\ObjectProvider[] $providers the providers.
   */
  public function __construct(Array $providers) {
    if (count($providers) < 2) {
      throw new \Bonder\Exceptions\Exception("At least two providers needed");
    }
    $this->providers = $providers;
  }
  
  /**
   * Returns the providers list.
   * 
   * @return \Bonder\Object\ObjectProvider[] the providers list.
   */
  public function getProviders() {
    return $this->providers;
  }
  
  public function getObject($object) {
    foreach ($this->providers as $provider) {
      $object = $provider->getObject($object);
    }
    return $object;
  }
  
}