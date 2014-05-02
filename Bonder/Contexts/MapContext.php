<?php
namespace Bonder\Contexts;

/**
 * Context implementation retrieves resources from a \Bonder\Collections\Map.
 *
 * @author hbandura
 */
final class MapContext implements \Bonder\Context {

  /**
   * @var \Bonder\Collections\Map
   */
  private $resources;
  
  /**
   * Create a new MapContext with the resources given. 
   *
   * @param \Bonder\Collections\Map $resources the resources.
   */
  public function __construct(\Bonder\Collections\Map $resources) {
    $this->resources = $resources;
  }

  public function get($resource) {
    if (!$this->resources->containsKey($resource)) {
      throw new \Bonder\Exceptions\ResourceNotFoundException();
    }

    return $this->resources->get($resource);
  }
}