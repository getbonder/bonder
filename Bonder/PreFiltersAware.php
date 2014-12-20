<?php
namespace Bonder;

/**
 * Contains Pre Filters configuration.
 *
 * @package Bonder
 * @author hbandura
 */
interface PreFiltersAware {

  /** Returns the Pre Filters configuration. Should return an array
   * mapping alias names to filter classes.
   *
   * @return array An array (alias => filter class name).
   */
  public function getPreFilters();

}