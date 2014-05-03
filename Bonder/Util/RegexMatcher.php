<?php

namespace Bonder\Util;

/**
 * PHP Regex implementation of \Bonder\Util\Matcher.
 * 
 * @author hbandura
 */
final class RegexMatcher implements \Bonder\Util\Matcher {
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Util.Matcher::match()
   */
  public function match($expression, $literal) {
    return 1 == @preg_match("#^{$expression}/?$#Ui", $literal);
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Util.Matcher::getMatchVariables()
   */
  public function getMatchVariables($expression, $literal) {
    $variables = array();
    $result = @preg_match_all("#^{$expression}/?$#Ui", $literal, $variables);
    if ($result === false) {
      throw new \Bonder\Exceptions\Exception(
        "Unmatched regex {$expression} : {$literal}");
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
  
}