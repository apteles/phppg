<?php

namespace PGPHPLIB\DML;

use PGPHPLIB\DML\Types\BooleanType;
use PGPHPLIB\DML\Types\NullType;
use PGPHPLIB\DML\Types\StringType;

class TransformQueryValues
{
    private array $values = [
        'labeled' => [],
        'raw'   => []
    ];

    public function __construct(array $values)
    {
        $this->setValues($values);
    }

    private function setValues(array $data): void
    {
        $this->values['raw'] = $this->transformValidDataType($data);
        $this->values['labeled'] = $this->createLabels($data);
    }

    public function getRawValues(): array
    {
        return $this->values['raw'];
    }

    public function getLabels(): array
    {
        return $this->values['labeled'];
    }

    private function transformValidDataType(array $data): array
    {
        $columnsTransformed = [];

        foreach (array_values($data) as $colum) {
            if (is_string($colum)) {
                $columnsTransformed[] = (new StringType($colum))->transform();
            } elseif (is_bool($colum)) {
                $columnsTransformed[] = (new BooleanType($colum))->transform();
            } elseif (is_null($colum)) {
                $columnsTransformed[] = (new NullType($colum))->transform();
            } else {
                $columnsTransformed[] = $colum;
            }
        }

        return $columnsTransformed;
    }

    private function createLabels(array $data): array
    {
        return array_map(function ($column) {
            return ":{$column}";
        }, array_keys($data));
    }
}
