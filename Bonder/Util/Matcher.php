<?php

namespace Bonder\Util;

/**
 * Matches strings.
 * 
 * @author hbandura
 */
interface Matcher {
  
  /**
   * Returns true iff the literal matches against the expression.
   * 
   * @param string $expression the expression.
   * @param string $literal the literal.
   */
  public function match($expression, $literal);
  
  /**
   * Returns the variables map extracted from the expression/literal match.
   * 
   * @param string $expression the expression.
   * @param string $literal the match.
   */
  public function getMatchVariables($expression, $literal);
  
}