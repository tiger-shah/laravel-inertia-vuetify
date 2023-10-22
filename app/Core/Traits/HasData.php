<?php

namespace App\Core\Traits;

use App\Core\ModelDataCollection;

trait HasData
{
    /**
     * @param string $constName
     * @return ModelDataCollection
     */
    public static function data(string $constName): ModelDataCollection
    {
        return new ModelDataCollection(constant("static::$constName"));
    }
}
