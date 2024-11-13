<?php

namespace Rubrica\Php\Components;

class HtmlElement {

public array $params;  

public function __construct($params = []) {

  $this->params = $params;

}

public function setParams($params): array {

  return $this->params = $params;
  
}
public function putParam($key) {

  if (count($this->params) > 0 && array_key_exists($key, $this->params)) 
    return $this->params[$key];

  return null;
  
}
public function render(): string {

  return "";
  
}

}
