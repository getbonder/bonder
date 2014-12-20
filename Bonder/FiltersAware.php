<?php
namespace Bonder;

/**
 * Contains Filters configuration.
 *
 * @package Bonder
 * @author hbandura
 */
interface FiltersAware {

  /** Returns the Filters configuration. Should return an array
   * mapping alias names to filter classes.
   *
   * @return array An array (alias => filter class name).
   */
  public function getFilters();

}