<?php

namespace App\Core;

use Illuminate\Support\Collection;

class ModelDataCollection extends Collection
{
    public function getName(int $key) {
        return $this->get($key)['name'];
    }

    public function getItemByName(string $name) {
        return $this->where('name', $name)->first();
    }

    public function getKeyByName(string $name) {
        return $this->search($this->getItemByName($name));
    }
}
