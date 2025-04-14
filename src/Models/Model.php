<?php

namespace Src\Models;

use Src\Db\MySQL;
use Src\Models\Traits\CheckFillableFields;

class Model extends MySQL
{
    use CheckFillableFields;

    protected string $table = '';
    protected array $fields = [];

    public function create(array $fields): void
    {

        if(!$this->checkFillableFields(fields: array_keys($fields), fillableFields: $this->fields)) {
            throw new \Exception(message: "This field is not fillable.");
        }

        $strFields = implode(separator: ',', array: array_keys($fields));

        $questionMarks = array_fill(start_index: 0, count: count($fields), value: '?');

        $query = "INSERT INTO ".$this->table." (".$strFields.") VALUES (".implode(separator: ',', array: $questionMarks).")";
        $stmt = $this->pdo->prepare(query: $query);

        $stmt->execute(params: array_values($fields));
    }

}