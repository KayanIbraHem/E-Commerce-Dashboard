<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class ExistsPerOrganizationRule implements Rule
{
    protected $table;
    protected $organizationId;
    protected $targetColumn;
    protected $column;

    public function __construct($table, $organizationId, $targetColumn, $column = null)
    {
        $this->table = $table;
        $this->organizationId = $organizationId;
        $this->targetColumn = $targetColumn;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        return DB::table($this->table)
            ->where($this->targetColumn, $value)
            ->where('organization_id', $this->organizationId)
            ->exists();
    }
    public function message()
    {
        return __('message.exists_in_table', ['attribute' => $this->column]);
    }
}
