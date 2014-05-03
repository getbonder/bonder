<?php

namespace BonderTest\Util;

/**
 * @author hbandura
 */
final class ContextConfiguratorTest extends \PHPUnit_Framework_TestCase {
  
  public function testThrow() {
    $context = $this->getMock("\Bonder\Context");
    $c = new \Bonder\Util\ContextConfigurator($context);
    try {
      $c->configure(null);
      $this->fail("Exception on null not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
    try {
      $c->configure(array());
      $this->fail("Exception on array not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testConfigurate() {
    $context = $this->getMock("\Bonder\Context");
    $c = new \Bonder\Util\ContextConfigurator($context);
    $aware = $this->getMock("\Bonder\ContextAware");
    $aware->expects($this->once())->method("setContext")->with($context);
    $aware2 = $this->getMock("\Bonder\ContextAware");
    $aware2->expects($this->once())->method("setContext")->with($context);
    $notAware = new \stdClass();
    $this->assertSame($aware, $c->configure($aware));
    $this->assertSame($notAware, $c->configure($notAware));
    $this->assertSame($aware2, $c->configure($aware2));
    $this->assertSame($context, $c->getContext());
  }
  
}