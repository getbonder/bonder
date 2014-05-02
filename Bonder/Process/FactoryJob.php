<?php

namespace Bonder\Process;

/**
 * Job implementation using a configuration factory and a filter chain
 * provider.
 * 
 * @author hbandura
 */
final class FactoryJob implements \Bonder\Process\Job {
  
  /**
   * @var \Bonder\Request
   */
  private $request;
  
  /**
   * @var \Bonder\Filters\FilterChain
   */
  private $filterChain;
  
  /**
   * Creates a new FactoryJob with the uri, request factory and the filter
   * chain provider given.
   * 
   * @param $uri the uri.
   * @param \Bonder\RequestFactory the request factory.
   * @param \Bonder\Filters\FilterChainProvider $filterChainProvider the 
   * filter chain provider.
   */
  public function __construct(
    $uri,
    \Bonder\RequestFactory $requestFactory,
    \Bonder\Filters\FilterChainProvider $filterChainProvider) {
    $fcpr = $filterChainProvider->get($uri);
    $this->request = $requestFactory->createRequest($fcpr->getUriVariables());
    $this->filterChain = $fcpr->getFilterChain();
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Process.Job::getRequest()
   */
  public function getRequest() {
    return $this->request;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Process.Job::getFilterChain()
   */
  public function getFilterChain() {
    return $this->filterChain;
  }
  
}