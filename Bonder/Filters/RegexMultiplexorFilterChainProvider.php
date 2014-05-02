<?php

namespace Bonder\Filters;

/**
 * Creates a filter chain from a URI given, searching for matches in the 
 * filters multiplexor and a controller in the controller multiplexor.
 * 
 * @author hbandura
 */
final class RegexMultiplexorFilterChainProvider implements FilterChainProvider {
  
  /**
   * @var \Bonder\Util\RegexMultiplexor
   */
  private $controllerMultiplexor;
  
  /**
   * @var \Bonder\Util\RegexMultiplexor
   */
  private $filterMultiplexor;
  
  /**
   * @var \Bonder\Object\ObjectProvider
   */
  private $objectProvider;
  
  /**
   * Creates a new RegexMultiplexorFilterChainProvider. Multiplexor values
   * are passed through the object provider to get the filters and the
   * controller.
   * 
   * @param \Bonder\Object\ObjectProvider $objectProvider the object provider.
   * @param \Bonder\Util\RegexMultiplexor $controllerMultiplexor the controller
   * multiplexor.
   * @param \Bonder\Util\RegexMultiplexor $filterMultiplexor the filters
   * multiplexor.
   */
  public function __construct(\Bonder\Object\ObjectProvider $objectProvider,
      \Bonder\Util\RegexMultiplexor $controllerMultiplexor,
      \Bonder\Util\RegexMultiplexor $filterMultiplexor) {
    $this->objectProvider = $objectProvider;
    $this->controllerMultiplexor = $controllerMultiplexor;
    $this->filterMultiplexor = $filterMultiplexor;
  }
  
  /**
   * Creates the filter chain for the given URI.
   * 
   * @param string $uri the uri.
   * @return \Bonder\Filters\FilterChainProviderResult the filter chain result,
   *  or null if no controller was found.
   */
  public function get($uri) {
    $controllerResult = $this->controllerMultiplexor->getFirstMatch($uri);
    if (is_null($controllerResult)) {
      return null;
    }

    $filterResults = $this->filterMultiplexor->getAllMatches($uri);
    $provider = $this->objectProvider;

    $controller = $provider->getObject($controllerResult->getValue());
    $filters = array_map(
      function (\Bonder\Util\RegexMultiplexorResult $v) use ($provider) {
        return $provider->getObject($v->getValue());
      }, $filterResults);
    return new \Bonder\Filters\FilterChainProviderResult(
      new \Bonder\Filters\FilterChain($filters, $controller),
      $controllerResult->getVariables());
  }
  
}