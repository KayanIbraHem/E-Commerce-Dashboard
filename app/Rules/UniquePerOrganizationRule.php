<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class UniquePerOrganizationRule implements Rule
{
    protected $organizationId;
    protected $table;
    protected $column;
    protected $ignoreId;

    public function __construct($organizationId, $table, $column = null, $ignoreId  = null)
    {
        $this->organizationId = $organizationId;
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
    }
    public function passes($attribute, $value)
    {
        // $validator = Validator::make([$attribute => $value], [
        //     $attribute => 'unique:' . $this->table . ',' . $attribute . ',NULL,id,organization_id,' . $this->organizationId
        // ]);
        // return !$validator->fails();

        $rule = ValidationRule::unique($this->table, $attribute)
            ->where('organization_id', $this->organizationId)->ignore($this->ignoreId);
        if ($this->ignoreId) {
            $rule->ignore($this->ignoreId);
        }

        $validator = Validator::make([$attribute => $value], [
            $attribute => [$rule]
        ]);

        return !$validator->fails();
    }
    public function message()
    {
        return __('message.unique_in_table', ['attribute' =>  $this->column]);
    }
}
