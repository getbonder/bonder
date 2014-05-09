<?php

namespace BonderTest;

/**
 * @author hbandura
 */
final class LauncherFactoryTest extends \PHPUnit_Framework_TestCase {
  
  protected function setUp() {
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
  }
  
  public function testHttp() {
    $filterChainProvider = $this->getMock("\Bonder\Filters\FilterChainProvider");
    $launcher = \Bonder\LauncherFactory::getHttp($filterChainProvider);
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
  
  public function testGetFCPBuilder() {
    $resources = array('aoeu' => 'aoeusnthaoeu', 'shou' => 37);
    $controllers = array('aoeuaoeu' => $this->getMock("\Bonder\Controller"));
    $filters = array('aoeuuuu' => $this->getMock("\Bonder\Filter"));
    $fcpBuilder = \Bonder\LauncherFactory::getStandardFCPBuilder(
      $resources, $controllers, $filters);
    $this->assertEquals($controllers, $fcpBuilder->getControllers());
    $this->assertEquals($filters, $fcpBuilder->getFilters());
    $context = $fcpBuilder->getContext();
    foreach ($resources as $k => $v) {
      $this->assertEquals($v, $context->get($k));
    }
  }
  
  public function testStandardHttp() {
    $resources = array('aoeu' => 'aoeusnthaoeu', 'shou' => 37);
    $controllers = array('aoeuaoeu' => $this->getMock("\Bonder\Controller"));
    $filters = array('aoeuuuu' => $this->getMock("\Bonder\Filter"));
    $launcher = \Bonder\LauncherFactory::getStandardHttp(
      $resources, $controllers, $filters);
    $this->assertEquals(
      \Bonder\LauncherFactory::getHttp(
        \Bonder\LauncherFactory::getStandardFCPBuilder(
          $resources, $controllers, $filters
        )->build()
      )
    , $launcher);
  }
  
  public function testStandardHttpWithDefault() {
    $resources = array('aoeu' => 'aoeusnthaoeu', 'shou' => 37);
    $controllers = array('aoeuaoeu' => $this->getMock("\Bonder\Controller"));
    $filters = array('aoeuuuu' => $this->getMock("\Bonder\Filter"));
    $controller = $this->getMock("\Bonder\Controller");
    $launcher = \Bonder\LauncherFactory::getStandardHttpWithDefault(
      $resources, $controllers, $filters, $controller);
    $this->assertEquals(
      \Bonder\LauncherFactory::getHttp(
        \Bonder\LauncherFactory::getStandardFCPBuilder(
          $resources, $controllers, $filters
        )->setDefaultController($controller)->build()
      )
      , $launcher);
  }
}