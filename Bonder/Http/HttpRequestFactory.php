<?php

namespace Bonder\Http;
use Bonder\Collections\Map;
use Bonder\Http\MapsHttpRequest;

/**
 * Creates requests of type \Bonder\Http\HttpRequest.
 * 
 * @author hbandura
 */
final class HttpRequestFactory implements \Bonder\RequestFactory {
  
  /**
   * (non-PHPdoc)
   * @see Bonder.RequestFactory::createRequest()
   */
  public function createRequest(Map $uriVariables) {
    return new MapsHttpRequest(
      Map::fromReference($_GET),
      Map::fromReference($_POST),
      Map::fromReference($_COOKIE),
      Map::fromReference($_SESSION),
      Map::fromReference($_SERVER),
      Map::fromReference($_FILES),
      $uriVariables,
      new Map()
    );
  }
  
}