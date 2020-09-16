<?php
namespace PGPHPLIB\DML\Types;

class ArrayType extends DataType
{
    private ?array $values = [];

    public function transform(): string
    {
        if (!is_array($this->value)) {
            throw new TypeException('Invalid Type');
        }

        $this->convertToValidTypes();
        return $this->format();
    }

    private function convertToValidTypes()
    {
        foreach ($this->value as $value) {
            if (is_integer($value)) {
                $numberType = new NumberType($value);
                $this->values[] = $numberType->transform();
            }
            if (is_string($value)) {
                $stringType = new StringType($value);
                $this->values[] = $stringType->transform();
            }
        }
    }

    private function format()
    {
        return "(". implode(',', $this->values) .")";
    }
}
