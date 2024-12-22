<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class OrderOptionBtn extends HtmlElement {

  public function render(): string {

    return
        "<div class='btn-group me-2'>
            <button type='button' class='btn btn-info dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            Ordina
            </button>
            <ul class='dropdown-menu p-1'>
            <li>
                <select class='form-select' aria-label='Default select example' name='order'>
                <option value='0'>Id</option>
                <option value='1'>Nome</option>
                <option value='2'>Cognome</option>
                <option value='3'>Telefono</option>
                <option value='4'>Compagnia</option>
                <option value='5'>Ruolo</option>
                <option value='6'>Email</option>
                <option value='7'>Data di nascita</option>
                <option value='8'>Data creazione</option>
                <option value='9'>Attivo</option>
                </select>
            </li>
            <li><hr class='dropdown-divider'></li>
            <li>
                <div class='form-check'>
                    <input class='form-check-input dec' type='checkbox' value='' id='flexCheckDefault' name='decr'>
                    <label class='form-check-label' for='flexCheckDefault'>
                        Decrescente
                    </label>
                </div>
            </li>
        </div>";
  }

}