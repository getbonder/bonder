<?php

namespace BonderTest\Http;

/**
 * @author hbandura
 * @author burzak
 */
final class HttpRequestTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $get = new \Bonder\Collections\Map();
    $post = new \Bonder\Collections\Map();
    $cookies = new \Bonder\Collections\Map();
    $session = new \Bonder\Collections\Map();
    $server = new \Bonder\Collections\Map();
    $files = new \Bonder\Collections\Map();
    $uriVariables = new \Bonder\Collections\Map();
    $request = new \Bonder\Http\HttpRequest(
      $get,
      $post,
      $cookies,
      $session,
      $server,
      $files,
      $uriVariables
    );
    $this->assertSame($get, $request->getGET());
    $this->assertSame($post, $request->getPOST());
    $this->assertSame($cookies, $request->getCookies());
    $this->assertSame($session, $request->getSession());
    $this->assertSame($server, $request->getServer());
    $this->assertSame($files, $request->getFiles());
    $this->assertSame($uriVariables, $request->getUriVariables());
  }
  
  /**
   * @param array $serverVars
   * @return HTTPRequest
   */
  public function create(Array $serverVars) {
    return new \Bonder\Http\HttpRequest(
      new \Bonder\Collections\Map(), // GET
      new \Bonder\Collections\Map(), // POST
      new \Bonder\Collections\Map(), // COOKIES
      new \Bonder\Collections\Map(), // SESSION
      \Bonder\Collections\Map::fromArray($serverVars),
      new \Bonder\Collections\Map(), // FILES
      new \Bonder\Collections\Map());// URI VARIABLES
  }
  
  public function testURI() {
    $testUri = "/927294g297u92hutoh.9279327.h298374?927292=,927o&onhu";
    $request = $this->create(array('DOCUMENT_URI' => $testUri));
    $this->assertEquals($testUri, $request->getUri());
  }
  
  public function testHost() {
    $testHost = "aoeustnhaoeustnh.astnhoaesutnh.astnhoaesntuh.com";
    $request = $this->create(array('HTTP_HOST' => $testHost));
    $this->assertEquals($testHost, $request->getHttpHost());
  }
  
  public function testHttpProtocol() {
    $request = $this->create(array());
    $this->assertEquals('http', $request->getHttpProtocol());
    
    $request = $this->create(array('HTTPS' => 'off'));
    $this->assertEquals('http', $request->getHttpProtocol());
    
    $request = $this->create(array('HTTPS' => 0));
    $this->assertEquals('http', $request->getHttpProtocol());
  }
  
  public function testHttpsProtocol() {
    $request = $this->create(array('HTTPS' => 'on'));
    $this->assertEquals('https', $request->getHttpProtocol());
    
    $request = $this->create(array('HTTPS' => 1));
    $this->assertEquals('https', $request->getHttpProtocol());
    
    $request = $this->create(array('SERVER_PORT' => '443'));
    $this->assertEquals('https', $request->getHttpProtocol());
  }
  
  public function testFullURL() {
    $testHost = "aoeustnhaoeustnh.astnhoaesutnh.astnhoaesntuh.com";
    $uri = "/298374928470239874087outnohedutoned.938724";
    $request = $this->create(array('SERVER_PORT' => '443', "HTTP_HOST" => $testHost, "DOCUMENT_URI" => $uri));
    $this->assertEquals("https://$testHost" . $uri, $request->getCurrentURL());
  }
  
  public function testMethod() {
    $request = $this->create(array('REQUEST_METHOD' => "GET"));
    $this->assertEquals("GET", $request->getMethod());
    
    $request = $this->create(array('REQUEST_METHOD' => "POST"));
    $this->assertEquals("POST", $request->getMethod());
  }
}