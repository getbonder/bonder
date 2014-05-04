<?php

namespace BonderTest;

/**
 * @author hbandura
 */
final class LauncherFactoryTest extends \PHPUnit_Framework_TestCase {
  
  public function testSimple() {
    global $_SERVER;
    global $_POST;
    global $_GET;
    global $_COOKIE;
    global $_FILES;
    global $_SESSION;
    $_SERVER = array();
    $_POST = array();
    $_GET = array();
    $_COOKIE = array();
    $_FILES = array();
    $_SESSION = array();
    $_SERVER['DOCUMENT_URI'] = '/aoeu/aoeu/aoeu';
    $filterChainProvider = $this->getMock("\Bonder\Filters\FilterChainProvider");
    $launcher = \Bonder\LauncherFactory::http($filterChainProvider);
    $this->assertSame($filterChainProvider, $launcher->getFilterChainProvider());
    $this->assertInstanceOf("\Bonder\Http\HttpConfigurationFactory", 
      $launcher->getConfigurationFactory());
    $this->assertNotNull($launcher->getProcessor());
    $this->assertNotNull($launcher->getOutputStream());
    $response = $this->getMock("\Bonder\Response");
    $response->expects($this->once())->method("writeTo")
      ->with($launcher->getOutputStream());
    $fc = $this->getMock("\Bonder\Filters\FilterChain");
    $fc->expects($this->once())->method("call")
      ->willReturn($response);
    $fcr = new \Bonder\Filters\FilterChainProviderResult($fc, 
      new \Bonder\Collections\Map());
    $filterChainProvider->expects($this->any())->method("get")
      ->with($_SERVER['DOCUMENT_URI'])->willReturn($fcr);
    $this->assertSame($response, $launcher->launch());
  }
  
}