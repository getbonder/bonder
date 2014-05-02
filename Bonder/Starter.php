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
   * @var \Bonder\Controller
   */
  private $default;
  
  /**
   * Creates a new Starter with the configuration given.
   * 
   * @param \Bonder\ConfigurationFactory $factory the factory.
   */
  public function __construct(\Bonder\ConfigurationFactory $factory) {
    $this->configurationFactory = $factory;
    $this->output = new \Bonder\Streams\StdOutStream();
    $this->providerFactory = new \Bonder\Object\StandardObjectProviderFactory();
    $this->default = new \Bonder\Controllers\LambdaController(function() {
      throw new \Bonder\Exceptions\NotImplementedException();
    });
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
    $context = new \Bonder\Contexts\MapContext(
      \Bonder\Collections\Map::fromArray($resources)
    );
    // Todo, wrap the controller and filters provider with a 
    // contextsetter to set the context.
    $controllerProvider = new \Bonder\Controllers\RegexControllerProvider(
      $controllerMultiplexor, 
      $this->default
    );
    $filtersProvider = new \Bonder\Filters\RegexFiltersProvider(
      $filtersMultiplexor);
    $chainProvider = new \Bonder\Filters\CrafterFilterChainProvider(
      $controllerProvider, 
      $filtersProvider
    );
    $uri = $this->configurationFactory->getUriProvider()->getUri();
    $job = new \Bonder\Process\FactoryJob(
      $uri, 
      $this->configurationFactory->getRequestFactory(), 
      $chainProvider);
    $processor = new \Bonder\Process\Processor();
    $response = $processor->process($job);
    $response->writeTo($this->output);
    return $response;
  }
  
}