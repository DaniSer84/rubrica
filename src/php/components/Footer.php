<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class Footer extends HtmlElement {

  public function render(): string {

    return
            "<footer class='border border-top mt-4' style='height:65px'>
                <div class='container container-fluid d-flex h-100 justify-content-around align-items-center h5'>
                    <a href='mailto:serenelli84@gmail.com'><em>@Daniser84</em></a>
                    <a href='https://github.com/DaniSer84'><i class='fa-brands fa-github'></i></a>
                </div>
            </footer>";
  }

}