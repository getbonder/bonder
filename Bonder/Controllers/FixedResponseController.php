<?php

namespace Bonder\Controllers;

/**
 * Always returns the same response.
 * 
 * @author hbandura
 */
final class FixedResponseController implements \Bonder\Controller {
  
  /**
   * @var \Bonder\Response
   */
  private $response;
  
  /**
   * Creates a new FixedResponseController, attached to a fixed response.
   * 
   * @param \Bonder\Response $response the response.
   */
  public function __construct(\Bonder\Response $response) {
    $this->response = $response;
  }
  
  public function service(\Bonder\Request $request) {
    return $this->response;
  }
  
}