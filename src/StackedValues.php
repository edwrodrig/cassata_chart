<?php
declare(strict_types=1);

namespace edwrodrig\cassata_chart;


class StackedValues
{
    private array $stackedValue = [];

    private string $label;

    private float $value;

    private array $originalValues = [];

    public function __construct(string $label, float $value, float ...$values) {
        $this->label = $label;
        $this->value = $value;
        $this->stackValue(...$values);
    }

    public function getLabel() : string {
        return $this->label;
    }

    public function stackValue(float ...$values) {
        foreach ( $values as $value) {
            $this->stackedValue[] = $value + $this->getLastValue();
            $this->originalValues[] = $value;
        }
    }

    private function getLastValue() : float {
        $size = $this->count();
        if ( $size == 0 ) return 0;
        return $this->stackedValue[$size - 1];
    }

    public function count() : int {
        return count($this->stackedValue);
    }

    public function getValue(int $index) : float {
        if ( $index < 0 ) return 0;
        return $this->stackedValue[$index];
    }

    public function getStartCoord(int $index) : array {
        return [$this->value, $this->getValue($index - 1)];
    }

    public function getEndCoord(int $index) : array {
        return [$this->value, $this->getValue($index)];
    }

    public function getLineCoords() : array {
        return [$this->getStartCoord(0), $this->getEndCoord($this->count() - 1)];
    }

    public function getOriginalValues() : array {
        return $this->originalValues;
    }
}