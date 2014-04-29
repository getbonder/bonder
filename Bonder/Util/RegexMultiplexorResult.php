<?php

namespace Bonder\Util;

/**
 * A matched regex multiplexor match result info.
 *
 * @author hbandura
 */
final class RegexMultiplexorResult {
  
  /**
   * @var string
   */
  private $regex;
  
  /**
   * @var string
   */
  private $literal;
    
  /**
   * @var mixed
   */
  private $value;
  
  /**
   * Creates a new RegexMultiplexorMatch with the data given.
   * 
   * @param string $regex the regex matched.
   * @param string $literal the literal string matching the regex.
   * @param mixed $value the value associated with the regex.
   */
  public function __construct($regex, $literal, $value) {
    $this->regex = $regex;
    $this->literal = $literal;
    $this->value = $value;
  }
  
  /**
   * Returns the regex matched.
   * 
   * @return string the regex.
   */
  public function getRegex() {
    return $this->regex;
  }
  
  /**
   * Returns the literal matching the regex.
   * 
   * @return string the literal.
   */
  public function getLiteral() {
    return $this->literal;
  }
    
  /**
   * Returns the variables map extracted from the literal.
   * 
   * @return \Bonder\Collections\Map the variables map.
   */
  public function getVariables() {
    $variables = array();
    $result = @preg_match_all("#^{$this->regex}/?$#Ui", $this->literal, $variables);
    if ($result === false) {
      throw new \Bonder\Exceptions\Exception(
        "Unmatched regex {$this->regex} : {$this->literal}");
    }
    $map = new \Bonder\Collections\Map();
    foreach ($variables as $k => $v) {
      if (count($v) != 1) {
        throw new \Bonder\Exceptions\Exception(
                "Unexpected array size in preg matching array");
      }
      $map->set($k, reset($v));
    }
    return $map;
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