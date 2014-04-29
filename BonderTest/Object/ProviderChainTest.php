<?php

namespace BonderTest\Object;

/**
 * @author hbandura
 */
final class ProviderChainTest extends \PHPUnit_Framework_TestCase {
  
  public function testThrow() {
    try {
      new \Bonder\Object\ProviderChain(array());
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
    try {
      new \Bonder\Object\ProviderChain(array($this->getMock("\Bonder\Object\ObjectProvider")));
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testChain() {
    $objs = array(
      new \stdClass(),
      new \stdClass(),
      new \stdClass(),
      new \stdClass()
    );
    $this->assertNotSame($objs[0], $objs[1]);
    $ops = array(
      $this->getMock("\Bonder\Object\ObjectProvider"),
      $this->getMock("\Bonder\Object\ObjectProvider"),
      $this->getMock("\Bonder\Object\ObjectProvider")
    );
    $pc = new \Bonder\Object\ProviderChain($ops);
    for ($i = 0; $i < count($ops); $i++) {
      $ops[$i]->expects($this->once())->method("getObject")->with($objs[$i])
        ->will($this->returnValue($objs[$i+1]));
    }
    $this->assertSame($objs[3], $pc->getObject($objs[0]));
    $this->assertEquals($ops, $pc->getProviders());
  }
  
}