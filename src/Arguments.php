<?php

namespace Amp\Injector;

use Amp\Injector\Meta\Parameter;

// TODO Readd index
final class Arguments implements Weaver
{
    /** @var Weaver[] */
    private array $weavers = [];

    public function with(Weaver $weaver): self
    {
        $clone = clone $this;
        $clone->weavers[] = $weaver;

        return $clone;
    }

    public function getDefinition(Parameter $parameter): ?Definition
    {
        foreach ($this->weavers as $weaver) {
            if ($definition = $weaver->getDefinition($parameter)) {
                return $definition;
            }
        }

        return null;
    }
}
