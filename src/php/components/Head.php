<?php

namespace Rubrica\Php\Components;

class Head {

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

    $title = $this->putParam("title");
    $style = $this->putParam("style");
    $script = $this->putParam("script");

    return
            "<head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>$title</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'
                  integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
              <link rel='stylesheet' href='$style'>
              <script src='https://kit.fontawesome.com/fb85e57258.js' crossorigin='anonymous'></script>
              <script src='$script' type='module'></script>
            </head>";
  }
}


