<?php

namespace Bonder\Filters;

/**
 * A filter chain used in a request dispatch.
 * 
 * @author hbandura
 */
final class SimpleFilterChain implements 
  \Bonder\Filters\FilterChain, 
  \Bonder\Filters\NextFilterCaller {
  
  /**
   * @var \Bonder\Filter[]
   */
  private $filters;
  
  /**
   * @var \Bonder\Controller
   */
  private $controller;
  
  /**
   * Creates a new FilterChain.
   * 
   * @param \Bonder\Filter[] $filters the filters, in order.
   * @param \Bonder\Controller $controller the controller, the end of the chain.
   */
  public function __construct(Array $filters, \Bonder\Controller $controller) {
    $this->filters = $filters;
    $this->controller = $controller;
  }
  
  /**
   * Returns the controller.
   * 
   * @return \Bonder\Controller the controller.
   */
  public function getController() {
    return $this->controller;
  }
  
  /**
   * Returns the filters list.
   * 
   * @return \Bonder\Filter[] the filters list.
   */
  public function getFilters() {
    return $this->filters;
  }
  
  /**
   * Executes the first filter in the chain. If no filters are available,
   * calls the controller.
   * 
   * @param \Bonder\Request $request the request.
   * @return \Bonder\Response the response.
   */
  public function call(\Bonder\Request $request) {
    if (empty($this->filters)) {
      return $this->controller->service($request);
    }
    $nextFilter = reset($this->filters);
    $nextFilters = array_slice($this->filters, 1);
    return $nextFilter->filter($request, 
      new SimpleFilterChain($nextFilters, $this->controller));
  }
  
}