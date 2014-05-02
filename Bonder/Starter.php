<?php

namespace Bonder;

/**
 * Bonder starter.
 * 
 * @author hbandura
 */
final class Starter {
  
  /**
   * @var \Bonder\ConfigurationFactory
   */
  private $configurationFactory;
  
  /**
   * @var \Bonder\Stream
   */
  private $output;
  
  /**
   * @var \Bonder\Object\ObjectProvider
   */
  private $providerFactory;
  
  /**
   * Creates a new Starter with the configuration given.
   * 
   * @param \Bonder\ConfigurationFactory $factory the factory.
   */
  public function __construct(\Bonder\ConfigurationFactory $factory) {
    $this->configurationFactory = $factory;
    $this->output = new \Bonder\Streams\StdOutStream();
    $this->providerFactory = new \Bonder\Object\StandardObjectProviderFactory();
  }
  
  /**
   * Starts bonder.
   * 
   * @param array $resources the resources.
   * @param array $controllers the controllers.
   * @param array $filters the filters.
   */
  public function start(Array $resources, Array $controllers, Array $filters) {
    $controllerMultiplexor = new \Bonder\Util\RegexMultiplexor($controllers);
    $filtersMultiplexor = new \Bonder\Util\RegexMultiplexor($filters);
    $context = new \Bonder\Contexts\LazyMapContext(
      \Bonder\Collections\Map::fromArray($resources),
      $this->providerFactory
    );
    $chainProvider = new \Bonder\Filters\RegexMultiplexorFilterChainProvider(
      $this->providerFactory->getObject($context),
      $controllerMultiplexor,
      $filtersMultiplexor
    );
    $processor = new Processor();
    $response = $processor->process($this->configurationFactory, 
      $chainProvider);
    $response->writeTo($this->output);
    return $response;
  }
  
}