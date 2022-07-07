<?php
class AbstractStrictData {
  function __construct()
  {
    $this->inspectPropTypes();
  }

  private function inspectPropTypes()
  {
    $props = get_object_vars($this);

    foreach ($props as $propName => $propValue) {
      if (gettype($propValue) === 'NULL') {
        throw new \InvalidArgumentException ('Property "'.$propName.'" can not be NULL in class "'.self::class.'" constructor. It might be initialized with some value.');
      } 
    }
  }

  public function __get($property)
  {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
    throw new \InvalidArgumentException('Class "'.self::class.'" does not have "'.$property.'" property');
  }
  
  public function __set($property, $value)
  {
    if (!property_exists($this, $property)) {
      throw new \InvalidArgumentException('Class "'.self::class.'" does not have "'.$property.'" property');
    }

    if (gettype($value) !== gettype($this->$property)) {
      throw new \InvalidArgumentException('Object property "'.$property.'" must be type "'.gettype($this->$property).'", "'.gettype($value).'" given.');
    }

    $this->$property = $value;
    return $this;
  }

  public function toArray()
  {
    $props = get_object_vars($this);
    $array = [];
    foreach ($props as $propName => $propValue) {
      $array[$propName] = $propValue;
    }
    return $array;
  }
}