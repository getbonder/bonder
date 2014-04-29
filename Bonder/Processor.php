<?php

namespace Bonder;

/**
 * Processes the current environment, with the configuration given.
 * 
 * @author hbandura
 */
final class Processor {
  
  /**
   * Processes the current environment, with the configuration given.
   * 
   * @param \Bonder\ConfigurationFactory $factory the configuration.
   * @param \Bonder\Filters\FilterChainProvider $chainProvider the filter
   * chain provider.
   * @return \Bonder\Response the response.
   */
  public function process(\Bonder\ConfigurationFactory $factory,
    \Bonder\Filters\FilterChainProvider $chainProvider) {
    $uri = $factory->getUriProvider()->getUri();
    $result = $chainProvider->get($uri);
    if (is_null($result)) {
      throw new \Bonder\Exceptions\Exception("No match for requested uri: $uri");
    }
    $request = $factory->
      getRequestFactory()->createRequest($result->getUriVariables());
    return $result->getFilterChain()->call($request);
  }
  
}