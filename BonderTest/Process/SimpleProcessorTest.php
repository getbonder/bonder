<?php

namespace BonderTest\Process;

/**
 * @author hbandura
 */
final class SimpleProcessorTest extends \PHPUnit_Framework_TestCase {
  
  public function testProcess() {
    $job = $this->getMock("\Bonder\Process\Job");
    $processor = new \Bonder\Process\SimpleProcessor();
    $fc = $this->getMock("\Bonder\Filters\FilterChain");
    $request = $this->getMock("\Bonder\Request");
    $response = $this->getMock("\Bonder\Response");
    $job->expects($this->any())->method("getFilterChain")
      ->willReturn($fc);
    $job->expects($this->any())->method("getRequest")
      ->willReturn($request);
    $fc->expects($this->once())->method("execute")
      ->with($request)->willReturn($response);
    $this->assertSame($response, $processor->process($job));
  }
  
}