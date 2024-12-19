<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class SearchInput extends HtmlElement {

  public function render($value = null): string {

    return
        "<form class='d-flex' role='search' method='GET'>
            <input name='search' class='form-control me-2' type='search' placeholder='Search' aria-label='Search' value='$value'>
            <button class='btn btn-outline-success' type='submit'>Cerca</button>
        </form>";
  }

}