<?php

namespace Bonder\Http;
use Bonder\Collections\Map;

/**
 * A http request made to the web server, created from Maps.
 * 
 * @author burzak
 * @author hbandura
 */
final class MapsHttpRequest implements \Bonder\Http\HttpRequest {
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $get;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $post;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $cookies;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $session;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $server;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $files;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $uriVariables;

  /**
   * @var \Bonder\Collections\Map
   */
  private $filterVariables;
  
  /**
   * Creates a new HTTPRequest with the server info given.
   * 
   * @param \Bonder\Collections\Map $get
   * @param \Bonder\Collections\Map $post
   * @param \Bonder\Collections\Map $cookies
   * @param \Bonder\Collections\Map $session
   * @param \Bonder\Collections\Map $server
   * @param \Bonder\Collections\Map $files
   * @param \Bonder\Collections\Map $uriVariables
   * @param \Bonder\Collections\Map $filterVariables
   */
  public function __construct(
          Map $get,
          Map $post,
          Map $cookies,
          Map $session,
          Map $server,
          Map $files,
          Map $uriVariables,
          Map $filterVariables
        ) {
    $this->get = $get;
    $this->post = $post;
    $this->cookies = $cookies;
    $this->session = $session;
    $this->server = $server;
    $this->files = $files;
    $this->uriVariables = $uriVariables;
    $this->filterVariables = $filterVariables;
  }
 
  public function getGET() {
    return $this->get;
  }

  public function getPOST() {
    return $this->post;
  }
  
  public function getCookies() {
    return $this->cookies;
  }
  
  public function getSession() {
    return $this->session;
  }

  public function getServer() {
    return $this->server;
  }

  public function getFiles() {
    return $this->files;
  }
  
  public function getMethod() {
    return $this->server->get("REQUEST_METHOD");
  }

  public function getUriVariables() {
    return $this->uriVariables;
  }

  public function getUri() {
    return $this->server->get("DOCUMENT_URI");
  }
  
  public function getCurrentURL() {
    return $this->getHttpProtocol() . '://' . $this->getHttpHost() . $this->getUri();
  }

  public function getHttpHost() {
    return $this->server->get('HTTP_HOST');
  }
  
  public function getHttpProtocol() {
    // Copied from https://github.com/facebook/facebook-php-sdk
    /*apache + variants specific way of checking for https*/
    if (in_array($this->server->get('HTTPS'), array(1, 'on', '1'), true)) {
      return 'https';
    }
    /*nginx way of checking for https*/
    if ($this->server->get('SERVER_PORT') === '443') {
      return 'https';
    }
    return 'http';
  }

  /**
   * Returns the filter variables;
   *
   * @return Map the filter variables;
   */
  public function getFilterVariables(){
    return $this->filterVariables;
  }
}