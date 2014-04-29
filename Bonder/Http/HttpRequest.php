<?php

namespace Bonder\Http;

/**
 * A http request made to the web server.
 * 
 * @author burzak
 * @author hbandura
 */
final class HttpRequest implements \Bonder\Request {
  
  /**
   * @var Bonder\Collections\Map
   */
  private $get;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $post;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $cookies;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $session;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $server;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $files;
  
  /**
   * @var Bonder\Collections\Map
   */
  private $uriVariables;
  
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
   */
  public function __construct(
          \Bonder\Collections\Map $get,
          \Bonder\Collections\Map $post,
          \Bonder\Collections\Map $cookies,
          \Bonder\Collections\Map $session,
          \Bonder\Collections\Map $server,
          \Bonder\Collections\Map $files,
          \Bonder\Collections\Map $uriVariables
        ) {
    $this->get = $get;
    $this->post = $post;
    $this->cookies = $cookies;
    $this->session = $session;
    $this->server = $server;
    $this->files = $files;
    $this->uriVariables = $uriVariables;
  }
 
  /**
   * Returns the GET \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the GET map.
   */
  public function getGET() {
    return $this->get;
  }

  /**
   * Returns the POST \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the POST map.
   */
  public function getPOST() {
    return $this->post;
  }
  
  /**
   * Returns the COOKIES \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the cookies map.
   */
  public function getCookies() {
    return $this->cookies;
  }
  
  /**
   * Returns the SESSION \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the session.
   */
  public function getSession() {
    return $this->session;
  }

  /**
   * Returns the SERVER \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the map.
   */
  public function getServer() {
    return $this->server;
  }

  /**
   * Returns the FILES \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the FILES map.
   */
  public function getFiles() {
    return $this->files;
  }
  
  /**
   * Returns the HTTP Method used.
   * 
   * @return string the method.
   */
  public function getMethod() {
    return $this->server->get("REQUEST_METHOD");
  }

  public function getUriVariables() {
    return $this->uriVariables;
  }

  public function getUri() {
    return $this->server->get("DOCUMENT_URI");
  }
  
  /**
   * Returns the current full url.
   * 
   * @return string the url.
   */
  public function getCurrentURL() {
    return $this->getHttpProtocol() . '://' . $this->getHttpHost() . $this->getUri();
  }

  /**
   * Returns the http host.
   * 
   * @return string the host.
   */
  public function getHttpHost() {
    return $this->server->get('HTTP_HOST');
  }
  
  /**
   * Returns the http protocol used ('http' or 'https')
   * 
   * @return string the protocol.
   */
  public function getHttpProtocol() {
    // Copied from https://github.com/facebook/facebook-php-sdk
    /*apache + variants specific way of checking for https*/
    if ($this->server->get('HTTPS') &&
      ($this->server->get('HTTPS') === 'on' || $this->server->get('HTTPS') == 1)) {
      return 'https';
    }
    /*nginx way of checking for https*/
    if ($this->server->get('SERVER_PORT') &&
      ($this->server->get('SERVER_PORT') === '443')) {
      return 'https';
    }
    return 'http';
  }
}