<?php

namespace Bonder\Controllers;

/**
 * Closure / lambda-function controller.
 * 
 * @author hbandura
 */

final class LambdaController implements \Bonder\Controller {
  
  /**
   * @var function
   */
  private $lambda;
  
  /**
   * Creates a new LambdaController with the lambda function given.
   * 
   * @param \Closure $lambda function.
   */
  public function __construct($lambda) {
    $this->lambda = $lambda;
    if (!is_callable($lambda)) {
      throw new \Bonder\Exceptions\Exception("Argument lambda is not callable");
    }
  }
  
  public function service(\Bonder\Request $request) {
    $function = $this->lambda;
    return $function($request);
  }
  
}