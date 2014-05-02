<?php

namespace BonderTest\Contexts;

/**
 * @author burzak
 * @author hbandura
 */
final class MapContextTest extends \PHPUnit_Framework_TestCase {

  public function testThrowResourceNotFoundException() {
    $context = new \Bonder\Contexts\MapContext(
      new \Bonder\Collections\Map());
    try {
      $context->get("not_resource");
      $this->fail("Exception not thrown");
    } catch (\Bonder\exceptions\ResourceNotFoundException $e) {
      // success
    }
  }
  
  public function testGetResource() {
    $resources = new \Bonder\Collections\Map();
    $resources->set("1", "one");
    $resources->set("2", "two");
    $context = new \Bonder\Contexts\MapContext($resources);
    $this->assertEquals("one", $context->get("1"));
    $this->assertEquals("two", $context->get("2"));
    $this->assertEquals("one", $context->get("1"));
  }
  
}