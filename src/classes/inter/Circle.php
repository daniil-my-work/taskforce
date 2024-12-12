<?php

namespace php2\classes\inter;

class Circle implements Shape
{
    private int $radius = 10;

    public function getArea(): float
    {
        return M_PI * pow($this->radius, 2);
    }
}
