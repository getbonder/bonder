<?php

namespace BonderTest\Builders;

/**
 * @author hbandura
 */
final class StandardControllerProviderBuilderTest 
  extends \PHPUnit_Framework_TestCase {
  
  public function testSimple() {
    $builder = new \Bonder\Builders\StandardControllerProviderBuilder();
    $controller = $this->getMock("\Bonder\Controller");
    $context = $this->getMock("\Bonder\Context");
    $controllers = array(
      'key1' => $this->getMock("\Bonder\Controller"),
      'key2(?P<id>\w*)' => $this->getMock("\Bonder\Controller"),
      "key3" => $this->getMock("\Bonder\Controllers\ContextAwareController")
    );
    $controllers["key3"]->expects($this->once())->method("setContext")
      ->with($context);
    
    $this->assertSame($builder, $builder->setContext($context));
    $this->assertSame($context, $builder->getContext());
    
    $this->assertSame($builder, $builder->setControllers($controllers));
    $this->assertSame($controllers, $builder->getControllers());
    
    $this->assertSame($builder, $builder->setDefaultController($controller));
    $this->assertSame($controller, $builder->getDefaultController());
    
    $cp = $builder->build();
    $this->assertInstanceOf("\Bonder\Controllers\ControllerProvider", $cp);
    $this->assertSame($controller, 
      $cp->getResult("/defaultme")->getController());
    $this->assertSame($controllers["key3"], 
      $cp->getResult("key3")->getController());
    $this->assertSame($controllers["key2(?P<id>\w*)"], 
      $cp->getResult("key224")->getController());
    $this->assertEquals(24, 
      $cp->getResult("key224")->getUriVariables()->get('id'));
  }
  
  public function testDefaults() {
    $builder = new \Bonder\Builders\StandardControllerProviderBuilder();
    $this->assertInstanceOf("\Bonder\Context", $builder->getContext());
    $this->assertInstanceOf("\Bonder\Controller", 
      $builder->getDefaultController());
    $this->assertTrue(is_array($builder->getControllers()));
  }
  
}