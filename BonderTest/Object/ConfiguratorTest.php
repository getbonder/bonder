<?php

namespace BonderTest\Object;

/**
 * @author hbandura
 */
final class ConfiguratorTest extends \PHPUnit_Framework_TestCase {
  
  public function testThrow() {
    $context = $this->getMock("\Bonder\Context");
    $c = new \Bonder\Object\Configurator($context);
    try {
      $c->getObject(null);
      $this->fail("Exception on null not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testConfigurate() {
    $context = $this->getMock("\Bonder\Context");
    $c = new \Bonder\Object\Configurator($context);
    $aware = $this->getMock("\Bonder\ContextAware");
    $aware->expects($this->once())->method("setContext")->with($context);
    $aware2 = $this->getMock("\Bonder\ContextAware");
    $aware2->expects($this->once())->method("setContext")->with($context);
    $notAware = new \stdClass();
    $this->assertSame($aware, $c->getObject($aware));
    $this->assertSame($notAware, $c->getObject($notAware));
    $this->assertSame($aware2, $c->getObject($aware2));
    $this->assertSame($context, $c->getContext());
  }
  
}