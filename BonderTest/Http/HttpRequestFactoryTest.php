<?php

namespace BonderTest\Http;

/**
 * @author hbandura
 */
final class HttpRequestFactoryTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreateRequest() {
    global $_GET; $_GET = array();
    global $_POST; $_POST = array();
    global $_SERVER; $_SERVER = array();
    global $_COOKIE; $_COOKIE = array();
    global $_FILES; $_FILES = array();
    global $_SESSION; $_SESSION = array();
    $factory = new \Bonder\Http\HttpRequestFactory();
    $uv = new \Bonder\Collections\Map();
    $request = $factory->createRequest($uv);
    $this->assertSame($uv, $request->getUriVariables());
    $this->assertTrue($request->getGET()->isLinkedTo($_GET));
    $this->assertTrue($request->getPOST()->isLinkedTo($_POST));
    $this->assertTrue($request->getCookies()->isLinkedTo($_COOKIE));
    $this->assertTrue($request->getFiles()->isLinkedTo($_FILES));
    $this->assertTrue($request->getServer()->isLinkedTo($_SERVER));
    $this->assertTrue($request->getSession()->isLinkedTo($_SESSION));
  }
  
}