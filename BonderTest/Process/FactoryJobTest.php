<?php

namespace BonderTest\Process;

/**
 * @author hbandura
 */
final class FactoryJobTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $uri = '/oenuthaoseu/aoeu/aoeu';
    $request = $this->getMock("\Bonder\Request");
    $uriVariables = new \Bonder\Collections\Map();
    $requestFactory = $this->getMock("\Bonder\RequestFactory");
    $filterChainProvider = $this->getMock("\Bonder\Filters\FilterChainProvider");
    $requestFactory->expects($this->once())->method("createRequest")
      ->with($uriVariables)->willReturn($request);
    $filterChain = $this->getMock("\Bonder\Filters\FilterChain");
    $fcpr = new \Bonder\Filters\FilterChainProviderResult($filterChain, $uriVariables);
    $filterChainProvider->expects($this->once())->method("get")
      ->with($uri)->willReturn($fcpr);
    $job = new \Bonder\Process\FactoryJob($uri, $requestFactory, $filterChainProvider);
    $this->assertSame($filterChain, $job->getFilterChain());
    $this->assertSame($request, $job->getRequest());
  }
  
}