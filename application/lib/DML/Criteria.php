<?php
namespace PGPHPLIB\DML;

class Criteria extends Expression
{
    private array $expressions = [];

    private array $operators = [];
    
    public function add(Expression $expression, string $operator = self::AND_OP): void
    {
        $this->expressions[] = $expression;
        $this->operators[] = $operator;
    }

    public function dump():string
    {
        $result = '';

        
        /**
         * @var Expression $expression
         */
        foreach ($this->expressions as $key => $expression) {
            $operator = $this->operators[$key];

            $result .= "{$operator}{$expression->dump()} ";
        }

        return $this->replaceFirstCharacter("AND", "", "($result)") ;
    }

    private function replaceFirstCharacter(string $search, string $replace, string $content): string
    {
        $search = '/'. preg_quote($search, '/') .'/';

        return preg_replace($search, $replace, $content, 1);
    }
}
