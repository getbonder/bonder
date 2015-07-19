<?php

namespace Bonder\Filters;
use Bonder\Filters\NextFilterCaller;
use Bonder\Request;

/**
 * Closure / lambda-function filter.
 * 
 * @author hbandura
 */
final class LambdaFilter implements \Bonder\Filter {
  
  /**
   * Callable function.
   *
   * @var callable
   */
  private $lambda;
  
  /**
   * Creates a new LambdaFilter with the lambda function given.
   * 
   * @param mixed $lambda function.
   */
  public function __construct($lambda) {
    $this->lambda = $lambda;
    if (!is_callable($lambda)) {
      throw new \Bonder\Exceptions\Exception("Argument lambda is not callable");
    }
  }
  
  public function filter(Request $request,
    NextFilterCaller $next) {
    $lambda = $this->lambda;
    return $lambda($request, $next);
  }
  
}