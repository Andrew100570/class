<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class MyValidator
{

    private $rules;

    /**
     * MyValidator constructor.
     */
    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function required($name)
    {
        return printf("Field %s can't be empty", $name);
    }

    public function email()
    {
        return "Wrong format of the email address";
    }

    public function url()
    {
        return "Wrong format of the url";
    }

    public function multiselect()
    {
        return "Not unique value";

    }

    public function hasErrors($fields)
    {
        return $this->validate($fields) != null;
    }

    public function validate($fields)
    {
        foreach ($this->rules as $field => $type) {
            if ($type == 'required') {
                if (!isset($fields[$field])) {
                    return $this->required($field);
                }
            } elseif ($type == 'email') {
                if (!filter_var($fields[$field], FILTER_VALIDATE_EMAIL)) {
                    return $this->email();
                }
            } elseif ($type == 'url') {
                if (!filter_var($fields[$field], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
                    return $this->url();
                }
            } elseif ($type == 'unique') {
                if (isset($fields['multiselect'])) {
                    $unique = array_unique($fields['multiselect']);
                    if (count($unique) != count($fields['multiselect'])) {
                        return $this->multiselect();
                    }
                }
            }
        }
        return null;
    }
}
