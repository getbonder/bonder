<?php

namespace Bonder\Util;

/**
 * Matches regular expressions to a value.
 *
 * @author hbandura
 */
final class RegexMultiplexor {
  
  /**
   * @var Array
   */
  private $values;
  
  /**
   * Creates a new RegexMultiplexor with the array ( regex => value ) given.
   * 
   * @param array $values
   */
  public function __construct(Array $values) {
    $this->values = $values;
  }
  
  /**
   * Returns the first match, testing the literal against the regex keys from 
   * the values array.
   * 
   * @param string $literal the literal string, to be tested against the 
   * regular expressions.
   * @return \Bonder\Util\RegexMultiplexorResult the matched result, or null if no match
   * is found.
   */
  public function getFirstMatch($literal) {
    $matches = $this->getMatches($literal, 1);
    if (!empty($matches)) {
      return reset($matches);
    }
    return null;
  }
  
  /**
   * Returns all matches, testing the literal against the regex keys from the
   * values array.
   * 
   * @param string $literal the literal string, to be tested against the
   * regular expressions.
   * @return \Bonder\Util\RegexMultiplexorResult[] the matched results.
   */
  public function getAllMatches($literal) {
    return $this->getMatches($literal);
  }
  
  private function getMatches($literal, $max = null) {
    $matches = array();
    foreach ($this->values as $regex => &$value) {
      if (!preg_match("#^{$regex}/?$#Ui", $literal)) {
        continue;
      }
      $matches[] = new \Bonder\Util\RegexMultiplexorResult($regex, $literal, $value);
      if (!is_null($max) && count($matches) >= $max) {
        break;
      }
    }
    return $matches;
  }
  
}