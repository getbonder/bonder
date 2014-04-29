<?php
namespace Bonder\Contexts;

/**
 * Context implementation which lazy instantiates the resources using a
 * \Bonder\Object\ObjectProvider
 *
 * @author burzak
 * @author hbandura
 */
final class LazyMapContext implements \Bonder\Context {

  /**
   * @var \Bonder\Collections\Map
   */
  private $lazyResources;

  /**
   * @var \Bonder\Collections\Map
   */
  private $resources;
  
  /**
   * @var \Bonder\Util\ObjectProvider
   */
  private $objectProvider;

  /**
   * Create a new LazyMapContext. The ObjectProvider is called with $this,
   * to obtain another ObjectProvider used in the creation of lazy resources.
   *
   * @param \Bonder\Collections\Map $resources the lazy resources.
   * @param \Bonder\Object\ObjectProvider $objectProviderFactory the provider
   * factory.
   */
  public function __construct(\Bonder\Collections\Map $resources, 
    \Bonder\Object\ObjectProvider $objectProviderFactory) {
    $this->lazyResources= $resources;
    $this->resources = new \Bonder\Collections\Map();
    $this->objectProvider = $objectProviderFactory->getObject($this);
  }

  public function get($resource) {
    if (!$this->lazyResources->containsKey($resource)) {
      throw new \Bonder\Exceptions\ResourceNotFoundException();
    }    

    if (!$this->resources->containsKey($resource)) {
      $this->resources->set(
        $resource,
        $this->objectProvider->getObject(
          $this->lazyResources->get($resource)
        )
      );
    }

    return $this->resources->get($resource);
  }
}