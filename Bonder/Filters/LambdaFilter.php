<?php

namespace Bonder\Filters;

/**
 * Closure / lambda-function filter.
 * 
 * @author hbandura
 */
final class LambdaFilter implements \Bonder\Filter {
  
  /**
   * @var function
   */
  private $lambda;
  
  /**
   * Creates a new LambdaFilter with the lambda function given.
   * 
   * @param function $lambda function.
   */
  public function __construct($lambda) {
    $this->lambda = $lambda;
    if (!is_callable($lambda)) {
      throw new \Bonder\Exceptions\Exception("Argument lambda is not callable");
    }
  }
  
  public function filter(\Bonder\Request $request, 
    \Bonder\Filters\NextFilterCaller $next) {
    $lambda = $this->lambda;
    return $lambda($request, $next);
  }
  
}