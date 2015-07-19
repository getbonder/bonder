<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
final class LambdaFilterTest extends \PHPUnit_Framework_TestCase {
  public function testSameParameters() {
    $self = $this;
    $originalRequest = $this->getMock("\Bonder\Request");
    $originalNext = $this->getMock("\Bonder\Filters\NextFilterCaller");
    $f = new \Bonder\Filters\LambdaFilter(
      function(\Bonder\Request $request, 
        \Bonder\Filters\NextFilterCaller $next) 
        use ($self, $originalRequest, $originalNext) {
        $self->assertSame($originalRequest, $request);
        $self->assertSame($originalNext, $next);
        return null;
      }
    );
    $f->filter($originalRequest, $originalNext);
    // Again!
    $f->filter($originalRequest, $originalNext);
  }
  
  public function testReturn() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getMock("\Bonder\Request");
    $next = $this->getMock("\Bonder\Filters\NextFilterCaller");
    $f = function(\Bonder\Request $request, 
      \Bonder\Filters\NextFilterCaller $next) use ($response) {
      return $response;
    };
    $filter = new \Bonder\Filters\LambdaFilter($f);
    $this->assertSame($response, $filter->filter($request, $next));
    // Again!
    $this->assertSame($response, $filter->filter($request, $next));
  }
  
}