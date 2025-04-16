<?php

namespace Src\Models;

use Src\Db\MySQL;
use Src\Models\Traits\CheckFillableFields;
use Src\Validation\ShouldValidate;

class Model extends MySQL
{
    use CheckFillableFields;

    protected string $table = '';
    protected array $fields = [];

    protected array $validationRules = [];

    public function create(array $fields): void
    {

        if (!$this->checkFillableFields(fields: array_keys($fields), fillableFields: $this->fields)) {
            throw new \Exception(message: "This field is not fillable.");
        }

        if(in_array(needle: ShouldValidate::class, haystack: class_uses($this))) {
            /** @var ShouldValidate $this */
            $x = $this->validateFields(values: $fields, validationRules: $this->validationRules);
            dd($x);
        }

        $strFields = implode(separator: ',', array: array_keys($fields));

        $questionMarks = array_fill(start_index: 0, count: count($fields), value: '?');

        $query = "INSERT INTO " . $this->table . " (" . $strFields . ") VALUES (" . implode(separator: ',', array: $questionMarks) . ")";
        $stmt = $this->pdo->prepare(query: $query);

        $stmt->execute(params: array_values($fields));
    }

}