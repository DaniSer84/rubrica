<?php

namespace Rubrica\Php\Components;

class Head {

  public string $title;

  public string $style;

  public string $scriptJs;

  public function __construct(string $title, string $style, string $scriptJs) {

    $this->title = $title;
    $this->style = $style;
    $this->scriptJs = $scriptJs;

  }
  
  public function getTitle(): string {

    return $this->title;
    
  }

  public function getStyle(): string {

    return $this->style;
    
  }

  public function getScriptJs(): string {

    return $this->scriptJs;
    
  }
  
  public function setTitle($title): string {

    $this->title = $title;

    return $this->title;
    
  }

  public function setStyle($style): string {

    $this->style = $style;

    return $this->style;
    
  }  

  public function setScript($scriptJs): string {

    $this->scriptJs = $scriptJs;

    return $this->scriptJs;
    
  }

  
  public function render(): string {

    $title = $this->getTitle();
    $style = $this->getStyle();
    $scriptJs = $this->getScriptJs();

    return
            "<head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>$title</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'
                  integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
              <link rel='stylesheet' href='$style'>
              <script src='https://kit.fontawesome.com/fb85e57258.js' crossorigin='anonymous'></script>
              <script src='$scriptJs' type='module'></script>
            </head>";
  }
}


