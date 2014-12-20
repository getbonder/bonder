<?php

namespace Bonder\Http;

/**
 * A controller for handling a HttpRequest.
 * 
 * @author hbandura
 * @author burzak
 */
abstract class HttpController implements \Bonder\Controller, \Bonder\ContextAware {
  
  /**
   * @var \Bonder\Context
   */
  private $context;

  public function getFilters() {
    // No filters in the default implementation.
    return array();
  }

  public function setContext(\Bonder\Context $context) {
    $this->context = $context;
  }

  public function getContext() {
    return $this->context;
  }

  public final function service(\Bonder\Request $request) {
    if (!$request instanceof \Bonder\Http\HttpRequest) {
      throw new \InvalidArgumentException("Received a non HttpRequest");
    }
    $method = $request->getMethod();
    return $this->$method($request);
  }

  /**
   * Returns the response for the http GET request given.
   * 
   * @param \Bonder\Http\HttpRequest $request the request.
   * @return \Bonder\Http\HttpResponse the response.
   */
  public function get(\Bonder\Http\HttpRequest $request) {
    throw new \Bonder\Exceptions\NotImplementedException();
  }
  
  /**
   * Returns the response for the http POST request given.
   * 
   * @param \Bonder\Http\HttpRequest $request the request.
   * @return \Bonder\Http\HttpResponse the response.
   */
  public function post(\Bonder\Http\HttpRequest $request) {
    throw new \Bonder\Exceptions\NotImplementedException();
  }
  
}