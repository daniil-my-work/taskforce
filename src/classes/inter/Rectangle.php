<?php

namespace php2\classes\inter;

class Rectangle implements Shape {
    private int $width = 10;
    private int $height = 5;

    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}