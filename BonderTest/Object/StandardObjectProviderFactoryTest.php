<?php

namespace BonderTest\Object;

/**
 * @author hbandura
 */
final class StandardObjectProviderFactoryTest extends
  \PHPUnit_Framework_TestCase {
  
  public function testThrow() {
    $sopf = new \Bonder\Object\StandardObjectProviderFactory();
    try {
      $sopf->getObject(null);
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
    try {
      $sopf->getObject(new \stdClass());
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testSimple() {
    $context = $this->getMock("\Bonder\Context");
    $sopf = new \Bonder\Object\StandardObjectProviderFactory();
    $op = $sopf->getObject($context);
    $this->assertInstanceOf("\Bonder\Object\ProviderChain", $op);
    $providers = $op->getProviders();
    $this->assertCount(2, $providers);
    $this->assertInstanceOf("\Bonder\Object\Creator", $providers[0]);
    $this->assertInstanceOf("\Bonder\Object\Configurator", $providers[1]);
    $this->assertSame($context, $providers[1]->getContext());
  }
  
}