<?php

namespace Bonder\Util;

/**
 * A value finder result info.
 *
 * @author hbandura
 */
final class ValueFinderResult {
  
  /**
   * @var string
   */
  private $key;
  
  /**
   * @var string
   */
  private $literal;
    
  /**
   * @var mixed
   */
  private $value;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $variables;
  
  /**
   * Creates a new ValueFinderResult with the data given.
   * 
   * @param string $key the key matched.
   * @param string $literal the literal string matching key.
   * @param mixed $value the value associated with the key.
   * @param \Bonder\Collections\Map $variables the variables.
   */
  public function __construct($key, $literal, $value, 
      \Bonder\Collections\Map $variables) {
    $this->key = $key;
    $this->literal = $literal;
    $this->value = $value;
    $this->variables = $variables;
  }
  
  /**
   * Returns the key of the value found.
   * 
   * @return string the key.
   */
  public function getKey() {
    return $this->key;
  }
  
  /**
   * Returns the literal used to find the value.
   * 
   * @return string the literal.
   */
  public function getLiteral() {
    return $this->literal;
  }
    
  /**
   * Returns the variables map extracted from the literal/key match.
   * 
   * @return \Bonder\Collections\Map the variables map.
   */
  public function getVariables() {
    return $this->variables;
  }
  
  /**
   * Returns the value associated with the matched regex.
   * 
   * @return mixed the value.
   */
  public function getValue() {
    return $this->value;
  }
  
}