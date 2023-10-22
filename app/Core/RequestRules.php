<?php

namespace App\Core;

use Illuminate\Support\Collection;

class RequestRules extends Collection
{
    public function addRequired(string|array $fields = null): static
    {
        if (is_string($fields)) {
            $fields = [$fields];
        } elseif ($fields === null) {
            $fields = $this->keys();
        }

        foreach ($fields as $field) {
            array_unshift($this->items[$field], 'required');
        }

        return $this;
    }

    public function addRequiredExcept(array $except_fields): static
    {
        $items = collect($this->items);
        return $this->addRequired($items->forget($except_fields)->keys()->items);
    }

    public function addRuleToField(string $field, $rule) {
        $this->items[$field][] = $rule;

        return $this;
    }
}
