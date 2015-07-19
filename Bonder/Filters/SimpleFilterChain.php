<?php

namespace Bonder\Filters;
use Bonder\Collections\Map;
use Bonder\Controller;
use Bonder\Request;

/**
 * A filter chain used in a request dispatch.
 * 
 * @author hbandura
 */
final class SimpleFilterChain implements 
  \Bonder\Filters\FilterChain {
  
  /**
   * @var \Bonder\Filter[]
   */
  private $filters;

  /**
   * @var Array(alias, \Bonder\Filter) []
   */
  private $filtersList;
  
  /**
   * @var Controller
   */
  private $controller;
  
  /**
   * Creates a new FilterChain.
   * 
   * @param \Bonder\Filter[] $filters the filters, in order.
   * @param Controller $controller the controller, the end of the chain.
   */
  public function __construct(Array $filters, Controller $controller) {
    $this->filters = $filters;
    $this->controller = $controller;
    foreach ($this->filters as $alias => $filter) {
      $this->filtersList[] = array($alias, $filter);
    }
  }
  
  /**
   * Returns the controller.
   * 
   * @return Controller the controller.
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
   * @param Request $request the request.
   * @return \Bonder\Response the response.
   */
  public function execute(Request $request) {
    return $this->executeStep($request, 0);
  }

  /**
   * Recursion entry point for next filter callers. Public because PHP lacks private inner classes.
   *
   * @param Request $request
   * @param $step
   * @param Map $filterVariables
   * @return mixed
   */
  public function executeStep(Request $request, $step) {
    if ($step < count($this->filtersList)) {
      list($alias, $filter) = $this->filtersList[$step];
      return $filter->filter($request, new SimpleFilterChainNextCaller($this, $step + 1, $alias));
    }
    if ($step == count($this->filtersList)) {
      return $this->controller->service($request);
    }
    throw new \InvalidArgumentException("Step can't be higher than the filters amount + 1");
  }

}

/** Utility class to simplify filter chain recursion. */
final class SimpleFilterChainNextCaller implements NextFilterCaller {

  /**
   * @var SimpleFilterChain
   */
  private $filterChain;

  /**
   * @var int
   */
  private $step;

  /**
   * @var string
   */
  private $alias;

  public function __construct(SimpleFilterChain $filterChain, $step, $alias) {
    $this->filterChain = $filterChain;
    $this->step = $step;
    $this->alias = $alias;
  }

  public function call(Request $request, Array $variables = array()) {
    if (!is_numeric($this->alias)) {
      $request->getFilterVariables()->set($this->alias, Map::fromArray($variables));
    }
    return $this->filterChain->executeStep($request, $this->step);
  }
}