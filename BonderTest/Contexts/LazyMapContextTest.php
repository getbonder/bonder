<?php

namespace BonderTest\Contexts;

/**
 * @author burzak
 * @author hbandura
 */
final class LazyMapContextTest extends \PHPUnit_Framework_TestCase {

  public function testThrowResourceNotFoundException() {
    $op = $this->getMock("\Bonder\Object\ObjectProvider");
    $context = new \Bonder\Contexts\LazyMapContext(
      new \Bonder\Collections\Map(), $op);
    try {
      $context->get("not_resource");
      $this->fail("Exception not thrown");
    } catch (\Bonder\exceptions\ResourceNotFoundException $e) {
      // success
    }
  }
  
  public function testCreateResource() {
    $resources = new \Bonder\Collections\Map();
    $resources->set("1", "one");
    $op = $this->getMock("\Bonder\Object\ObjectProvider");
    $opf = $this->getMock("\Bonder\Object\ObjectProvider");
    $opf->expects($this->once())->method("getObject")->willReturn($op);
    $op->expects($this->once())->method("getObject")->with("one")->willReturn("_ONE_");
    $context = new \Bonder\Contexts\LazyMapContext($resources, $opf);
    $this->assertEquals("_ONE_", $context->get("1"));
    $this->assertEquals("_ONE_", $context->get("1"));
  }
  
  public function testGetProvider() {
    $resources = new \Bonder\Collections\Map();
    $op = $this->getMock("\Bonder\Object\ObjectProvider");
    $opf = $this->getMock("\Bonder\Object\ObjectProvider");
    $receivedContext = null;
    $opf->expects($this->once())->method("getObject")->with($this->callback(
      function(\Bonder\Contexts\LazyMapContext $context) use (&$receivedContext) {
        $receivedContext = $context;
        return true;
      }
    ))->willReturn($op);
    $context = new \Bonder\Contexts\LazyMapContext($resources, $opf);
    $this->assertSame($context, $receivedContext);
  }
}