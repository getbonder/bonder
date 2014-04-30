<?php

namespace Bonder\Http;

/**
 * A http request made to the web server.
 * 
 * @author burzak
 * @author hbandura
 */
interface HttpRequest extends \Bonder\Request {
   
  /**
   * Returns the GET \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the GET map.
   */
  public function getGET();

  /**
   * Returns the POST \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the POST map.
   */
  public function getPOST();
  
  /**
   * Returns the COOKIES \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the cookies map.
   */
  public function getCookies();
  
  /**
   * Returns the SESSION \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the session.
   */
  public function getSession();

  /**
   * Returns the SERVER \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the map.
   */
  public function getServer();

  /**
   * Returns the FILES \Bonder\Collections\Map params.
   * 
   * @return \Bonder\Collections\Map the FILES map.
   */
  public function getFiles();
  
  /**
   * Returns the HTTP Method used.
   * 
   * @return string the method.
   */
  public function getMethod();

  /**
   * (non-PHPdoc)
   * @see Bonder.Request::getUriVariables()
   */
  public function getUriVariables();

  /**
   * (non-PHPdoc)
   * @see Bonder.Request::getUri()
   */
  public function getUri();
  
  /**
   * Returns the current full url.
   * 
   * @return string the url.
   */
  public function getCurrentURL();

  /**
   * Returns the http host.
   * 
   * @return string the host.
   */
  public function getHttpHost();
  
  /**
   * Returns the http protocol used ('http' or 'https')
   * 
   * @return string the protocol.
   */
  public function getHttpProtocol();
  
}