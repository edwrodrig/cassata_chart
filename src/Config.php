<?php
declare(strict_types=1);

namespace edwrodrig\lasagna_chart;


class Config
{
    private array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function getPalette() : Palette {
        return new Palette(array_values($this->data));
    }

    public function getOrder() : array {
        return array_keys($this->data);
    }
}