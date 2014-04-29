<?php

namespace Bonder\Http;

/**
 * Creates requests of type \Bonder\Http\HttpRequest.
 * 
 * @author hbandura
 */
final class HttpRequestFactory implements \Bonder\RequestFactory {
  
  public function createRequest(\Bonder\Collections\Map $uriVariables) {
    return new \Bonder\Http\HttpRequest(
      \Bonder\Collections\Map::fromReference($_GET),
      \Bonder\Collections\Map::fromReference($_POST),
      \Bonder\Collections\Map::fromReference($_COOKIE),
      \Bonder\Collections\Map::fromReference($_SESSION),
      \Bonder\Collections\Map::fromReference($_SERVER),
      \Bonder\Collections\Map::fromReference($_FILES),
      $uriVariables
    );
  }
  
}