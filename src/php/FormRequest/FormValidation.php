<?php

namespace Rubrica\Php\FormRequest;

use Rubrica\Php\Helper;

class FormValidation {

     // TODO: form validation

        // TODO: Server-side form validation -> PHP: htmlspecialchars, etc...
            // https://www.slingacademy.com/article/how-to-validate-form-in-php/
            // https://www.w3docs.com/learn-php/php-form-validation.html
            // https://www.phptutorial.net/php-tutorial/php-form/
            // https://mailtrap.io/blog/php-form-validation/

        // IMPROVMENTS:
            // TODO: study regular expressions -> best email regex

    public array $insertFields;

    private array $updateFields;

    public const ERRORS = [
        'ERROR_0' => 'Questo campo è obbligatorio.',
        'ERROR_NAME_1' => 'Per favore inserisci un nome valido (es: "Luca", "Gian Marco", ecc.).',
        'ERROR_NAME_2' => 'Il nome non deve superare i 40 caratteri',
        'ERROR_SURNAME_1' => 'Per favore inserisci un cognome valido (es: "Serenelli", "Forbes-Hamilton", ecc.).',
        'ERROR_SURNAME_2' => 'Il cognome non deve superare i 40 caratteri',
        'ERROR_PHONE_1' => 'Per favore inserisci un numero di telefono valido (es: 3331234567 / 00391234567890).',
        'ERROR_PHONE_2' => 'Il numero di telefono deve essere compreso tra le 8 a le 14 cifre.',
        'ERROR_EMAIL_1' => 'Per favore inserisci un indirizzo email valido (es: esempio@dominio.com).',
        'ERROR_DATE_1' => 'Per favore inserisci una data valida (es: mm/gg/yyyy).',
        'ERROR_DATE_2' => 'La data deve essere compresa tra il 01/01/1900 e il 12/31/2017.',
    ];

    public function __construct() {

        $this->updateFields = Helper::filterFields(Helper::FIELDS, ['id', 'picture', 'created_at']);
        $this->insertFields = Helper::filterFields($this->updateFields, ['active']);
        
    }
 
    public function validatePhone($value): ?string {

        if ($value === '') {

            return 'ERROR_0';
            
        }
        
        if (!preg_match('/^[0-9]+$/', $value)) {

            return 'ERROR_PHONE_1';

        }
        
        if (strlen($value) < 8 || strlen($value) > 14) {

            return 'ERROR_PHONE_2';

        }

        return $value;
        
    }
    
    public function validateName($value) {

        if ($value === '') {

            return 'ERROR_0';
            
        }

        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $value)) {

            return 'ERROR_NAME_1';
            
        }

        if (strlen($value) > 40) {

            return 'ERROR_NAME_2';
            
        }

        return $value;
        
    }

    private function validateSurname($value) {

        if ($value !== '') {

            if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $value)) {
    
                return 'ERROR_SURNAME_1';
                
            }
    
            if (strlen($value) > 40) {
    
                return 'ERROR_SURNAME_2';
                
            }

        }

        return $value;
        
    }

    private function validateEmail($value) {

        if ($value === '') {

            return 'ERROR_0';
            
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {

            return 'ERROR_EMAIL_1';
            
        }
        
        return $value;
        
    }

    private function validateDate($value) {

        if ($value !== '') {

            $testDate = explode('-', $value);
    
            if (!count($testDate) === 3 || !checkdate($testDate[1], $testDate[2], $testDate[0])) {
    
                return 'ERROR_DATE_1';
                
            }

            if ($testDate[0] < 1900 || $testDate[0] > 2017) {

                return 'ERROR_DATE_2';
                
            }
            
        }
        
        return $value;
        
    }

    public function validateData($array) {

        $checkedData = filter_var_array($array, [
            'name' => [
                'filter' => FILTER_CALLBACK,
                'options' => [$this, 'validateName']
            ],
            'surname' => [
                'filter' => FILTER_CALLBACK,
                'options' => [$this, 'validateSurname']
            ],
            'phone_number' => [
                'filter' => FILTER_CALLBACK,
                'options' => [$this, 'validatePhone']
            ],
            'email' => [
                'filter' => FILTER_CALLBACK,
                'options' => [$this, 'validateEmail']
            ],
            'company' => FILTER_DEFAULT,
            'role' => FILTER_DEFAULT,
            'birthdate' => [
                'filter' => FILTER_CALLBACK,
                'options' => [$this, 'validateDate'] 
            ]
            ]);

        $hasErrors = array_filter($checkedData, fn($v) => array_key_exists($v, self::ERRORS));

        return [$checkedData, $hasErrors];
        
    }

    public function sanitizeInput($array, $mode = 'insert') {

        $filtered = array_filter($array, fn($k) => in_array($k,
                              $mode === 'insert' ? 
                                        $this->insertFields : 
                                        $this->updateFields), 
                                        ARRAY_FILTER_USE_KEY);
        
        $filters = [
            'trim',
            'stripslashes',
            'htmlspecialchars'
        ];

        foreach ($filters as $filter) {

            $filtered = array_map($filter, $filtered);
            
        }

        return $filtered;
    }

    
}