<?php

namespace Bonder\Http;

/**
 * Returns the URI requested through HTTP.
 * 
 * @author hbandura
 */
final class HttpUriProvider implements \Bonder\UriProvider {
  
  public function getUri() {
    return isset($_SERVER["DOCUMENT_URI"])?$_SERVER["DOCUMENT_URI"]:null;
  }
  
}