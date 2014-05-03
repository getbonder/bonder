<?php

namespace Bonder\Collections;

/**
 * Map collection.
 * 
 * @author hbandura
 */
class Map {
  
  /**
   * Returns a new Map, built with the data given in the array.
   * 
   * @param array $array the array.
   * @return \Bonder\Collections\Map the map.
   */
  public static function fromArray(Array $array) {
    $map = new \Bonder\Collections\Map();
    foreach ($array as $k => $v) {
      $map->set($k, $v);
    }
    return $map;
  }
  
  /**
   * Returns a new Map, linked to the array given.
   * 
   * @param array $array the array to link to.
   * @return \Bonder\Collections\Map the map.
   */
  public static function fromReference(Array &$array) {
    $map = new \Bonder\Collections\Map();
    $map->linkTo($array);
    return $map;
  }
  
  /**
   * @var Array
   */
  private $values;
  
  /**
   * Creates a new Map.
   */
  public function __construct() {
    $this->values = array();
  }
  
  /**
   * Links the Map to the array given. Destroy all previously stored data.
   * 
   * @param Array $array the array to link to.
   */
  public function linkTo(Array &$array) {
    $this->values = &$array;
  }
  
  /**
   * Returns true iff this Map is linked to the array given.
   * 
   * @param array $array the array to test if linked.
   */
  public function isLinkedTo(Array &$array) {
    // Ugly implementation, is there any better way to do this in php?
    // haven't found a way to compare references for arrays
    // since spl_object_hash only works for objects.
    $initialCount = count($array);
    $this->values[] = TRUE; // Test value
    $linked = (count($array) > $initialCount);
    array_pop($this->values);
    return $linked;
  }
  
  /**
   * Returns the value assigned to the given key.
   * 
   * @param string $key the key.
   * @param mixed $default the default value, if the key is missing.
   * @return mixed the value.
   */
  public function get($key, $default = null) {
    if (!isset($this->values[$key])) {
      return $default;
    }
    return $this->values[$key];
  }
  
  /**
   * Sets the given value under the specified key.
   * 
   * @param string $key the key.
   * @param mixed $value the value.
   */
  public function set($key, $value) {
    $this->values[$key] = $value;
  }
  
  /**
   * Removes the specified key from the map.
   * 
   * @param string $key the key.
   */
  public function remove($key) {
    unset($this->values[$key]);
  }
  
  /**
   * Returns true iff the map is empty.
   * 
   * @return boolean true iff the map is empty.
   */
  public function isEmpty() {
    return count($this->values) == 0;
  }
  
  /**
   * Returns the size of the map.
   * 
   * @return int the size.
   */
  public function size() {
    return count($this->values);
  }

  /**
   * Returns true iff key is set
   *
   * @param string $key the key.
   * @return boolean true iff key is set. 
   */
  public function containsKey($key) {
    return isset($this->values[$key]);
  }
  
  /**
   * Returns true iff this map contains all key/values from the $otherMap.
   * 
   * @param Map $otherMap the other map.
   * @return boolean true iff this map contains all key/values from the
   * $otherMap.
   */
  public function contains(Map $otherMap) {
    foreach ($otherMap->values as $k => $v) {
      if (!$this->containsKey($k)) {
        return false;
      }
      if ($this->get($k) != $v) {
        return false;
      }
    }
    return true;
  }
  
}