<?php

namespace BonderTest\Http;
use Bonder\Collections\Map;

/**
 * @author hbandura
 * @author burzak
 */
final class MapsHttpRequestTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $get = new Map();
    $post = new Map();
    $cookies = new Map();
    $session = new Map();
    $server = new Map();
    $files = new Map();
    $uriVariables = new Map();
    $filterVariables = new Map();
    $request = new \Bonder\Http\MapsHttpRequest(
      $get,
      $post,
      $cookies,
      $session,
      $server,
      $files,
      $uriVariables,
      $filterVariables
    );
    $this->assertSame($get, $request->getGET());
    $this->assertSame($post, $request->getPOST());
    $this->assertSame($cookies, $request->getCookies());
    $this->assertSame($session, $request->getSession());
    $this->assertSame($server, $request->getServer());
    $this->assertSame($files, $request->getFiles());
    $this->assertSame($uriVariables, $request->getUriVariables());
    $this->assertSame($filterVariables, $request->getFilterVariables());
  }
  
  /**
   * @param array $serverVars
   * @return HTTPRequest
   */
  public function create(Array $serverVars) {
    return new \Bonder\Http\MapsHttpRequest(
      new Map(), // GET
      new Map(), // POST
      new Map(), // COOKIES
      new Map(), // SESSION
      Map::fromArray($serverVars),
      new Map(), // FILES
      new Map(), // URI VARIABLES
      new Map());// FILTER VARIABLES
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