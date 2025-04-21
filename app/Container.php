<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            return $entry($this);
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {

        # 1. Inspect the class that were are trying to get from the Container..}

        $class = new ReflectionClass(objectOrClass: $id);
        if (!$class->isInstantiable()) {
            throw new ContainerException('Class ' . $id . ' is not instantiable');
        }

        # 2. Inspet the constructor of the class
        $constructor = $class->getConstructor();
        if (!$constructor) {
            return new $id;
        }

        # 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }

        # 4. If the constructor parameter is a class then try to resolve that class using the container..

        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if (!$type) {
                throw new ContainerException('Failed to resolve ' . $id . ' because param' . $name . ' is missing a type hint.');
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException('Failed to resolve ' . $id . ' because of union type for param' . $name);
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException('Failed to resolve ' . $id . ' because invalidw param' . $name);
        }, $parameters);

        return $class->newInstanceArgs($dependencies);
    }
}
