<?php

namespace BonderTest;

/**
 * @author hbandura
 */
final class LauncherTest extends \PHPUnit_Framework_TestCase {
  
  public function testProperties() {
    $launcher = new \Bonder\Launcher();
    $output = $this->getMock("\Bonder\Stream");
    $processor = $this->getMock("\Bonder\Process\Processor");
    $filterChainProvider = $this->getMock("\Bonder\Filters\FilterChainProvider");
    $factory = $this->getMock("\Bonder\ConfigurationFactory");
    $launcher->setOutputStream($output)
      ->setFilterChainProvider($filterChainProvider)
      ->setConfigurationFactory($factory)
      ->setProcessor($processor);
    $this->assertSame($launcher, $launcher->setProcessor($processor));
    $this->assertSame($output, $launcher->getOutputStream());
    $this->assertSame($filterChainProvider, $launcher->getFilterChainProvider());
    $this->assertSame($factory, $launcher->getConfigurationFactory());
    $this->assertSame($processor, $launcher->getProcessor());
  }
  
  public function testLaunch() {
    $output = $this->getMock("\Bonder\Stream");
    $fcp = $this->getMock("\Bonder\Filters\FilterChainProvider");
    $cf = $this->getMock("\Bonder\ConfigurationFactory");
    $processor = $this->getMock("\Bonder\Process\Processor");
    $launcher = new \Bonder\Launcher();
    $launcher->setOutputStream($output)
      ->setFilterChainProvider($fcp)
      ->setConfigurationFactory($cf)
      ->setProcessor($processor);
    
    $uri = '/aoeu/aoesnthu/asnthaoeusn/asoetuh';
    
    $response = $this->getMock("\Bonder\Response");
    
    $fc = $this->getMock("\Bonder\Filters\FilterChain");
    
    $uriVariables = new \Bonder\Collections\Map();
    $fcpr = new \Bonder\Filters\FilterChainProviderResult($fc, $uriVariables);
    
    $fcp->expects($this->any())->method("get")
      ->with($uri)->willReturn($fcpr);
    
    $cf->expects($this->any())->method("get")
      ->with($uri)->willReturn($fc);
    $request = $this->getMock("\Bonder\Request");
    $rf = $this->getMock("\Bonder\RequestFactory");
    $rf->expects($this->any())->method("createRequest")
      ->with($uriVariables)->willReturn($request);
    $up = $this->getMock("\Bonder\UriProvider");
    $up->expects($this->any())->method("getUri")
      ->willReturn($uri);
    $cf->expects($this->any())->method("getRequestFactory")
      ->willReturn($rf);
    $cf->expects($this->any())->method("getUriProvider")
      ->willReturn($up);
    
    $job = new \Bonder\Process\FactoryJob($uri, $rf, $fcp);
    
    $processor->expects($this->once())->method("process")
      ->with($this->equalTo($job))->willReturn($response);
    
    $response->expects($this->once())->method("writeTo")
      ->with($output);
    
    $launcherResponse = $launcher->launch();
    
    $this->assertSame($launcherResponse, $response);
  }
  
}