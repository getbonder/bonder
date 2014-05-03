<?php

namespace Bonder\Util;

/**
 * Iterates over an array to find values, matching the key to the literal.
 *
 * @author hbandura
 */
final class MatcherValueFinder implements \Bonder\Util\ValueFinder {
  
  /**
   * @var Array
   */
  private $values;
  
  /**
   * @var \Bonder\Util\Matcher
   */
  private $matcher;
  
  /**
   * Creates a new MatcherValueFinder with the matcher and array given.
   * 
   * @param \Bonder\Util\Matcher $matcher the matcher.
   * @param array $values the values.
   */
  public function __construct(\Bonder\Util\Matcher $matcher, Array $values) {
    $this->values = $values;
    $this->matcher = $matcher;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Util.ValueFinder::getFirstValue()
   */
  public function getFirstValue($literal) {
    $matches = $this->getMatches($literal, 1);
    if (!empty($matches)) {
      return reset($matches);
    }
    return null;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Util.ValueFinder::getAllValues()
   */
  public function getAllValues($literal) {
    return $this->getMatches($literal);
  }
  
  /**
   * @param string $literal
   * @param int $max
   * @return \Bonder\Util\ValueFinderResult[]
   */
  private function getMatches($literal, $max = null) {
    $matches = array();
    foreach ($this->values as $key => &$value) {
      if (!is_null($max) && count($matches) >= $max) {
        break;
      }
      $this->addIfMatch($matches, $key, $value, $literal);
    }
    return $matches;
  }
  
  /**
   * @param array $matches
   * @param integer|string $key
   * @param mixed $value
   * @param string $literal
   */
  private function addIfMatch(Array &$matches, $key, &$value, $literal) {
    if (!$this->matcher->match($key, $literal)) {
      return;
    }
    $matches[] = new \Bonder\Util\ValueFinderResult(
      $key, $literal, $value,
      $this->matcher->getMatchVariables($key, $literal)
    );
  }
  
}