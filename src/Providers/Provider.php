<?php

namespace Astrogoat\Utm\Providers;

use Illuminate\Contracts\Support\Arrayable;

interface Provider extends Arrayable
{
    public function put(array $parameters): static;

    public function clear(): void;
}
