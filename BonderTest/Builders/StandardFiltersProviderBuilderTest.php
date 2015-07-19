<?php

namespace BonderTest\Builders;

/**
 * @author hbandura
 */
final class StandardFiltersProviderBuilderTest 
  extends \PHPUnit_Framework_TestCase {
  
  public function testSimple() {
    $controller = $this->getMock("\Bonder\Controller");
    $controller->expects($this->any())->method("getFilters")->willReturn(array());
    $builder = new \Bonder\Builders\StandardFiltersProviderBuilder();
    $context = $this->getMock("\Bonder\Context");
    $f1 = $this->getMock("\Bonder\Filters\Filter");
    $f2 = $this->getMock("\Bonder\Filters\ContextAwareFilter");
    $f3 = $this->getMock("\Bonder\Filter");
    $f4 = $this->getMock("\Bonder\Filter");
    $f2->expects($this->once())->method("setContext")
      ->with($context);
    $filters = array(
      "key1.*" => $f1,
      "key2.*" => $f2,
      "key3.*" => $f3,
      "key.*end" => $f4
    );
    $this->assertSame($builder, $builder->setContext($context));
    $this->assertSame($context, $builder->getContext());
    $this->assertSame($builder, $builder->setFilters($filters));
    $this->assertSame($filters, $builder->getFilters());
    $fp = $builder->build();
    $key1aFilters = $fp->getFilters("key1a", $controller);
    $this->assertSame($f1, $key1aFilters[0]);
    $this->assertCount(1, $key1aFilters);
    
    $key2bFilters = $fp->getFilters("key2b", $controller);
    $this->assertCount(1, $key2bFilters);
    $this->assertSame($f2, $key2bFilters[0]);
    
    $key3endFilters = $fp->getFilters("key3end", $controller);
    $this->assertCount(2, $key3endFilters);
    $this->assertEquals(array($f3, $f4), $key3endFilters);
    
    $emptyFilters = $fp->getFilters("nothing", $controller);
    $this->assertEmpty($emptyFilters);
  }
  
  public function testDefaults() {
    $builder = new \Bonder\Builders\StandardFiltersProviderBuilder();
    $this->assertInstanceOf("\Bonder\Context", $builder->getContext());
    $this->assertTrue(is_array($builder->getFilters()));
  }
  
}