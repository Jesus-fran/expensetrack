<?php

declare(strict_types=1);

namespace App;

class View
{
    protected string $viewPath;
    protected array $params;

    public function __construct(string $viewPath, array $params)
    {
        $this->viewPath = $viewPath;
        $this->params = $params;
    }

    public static function make(string $viewName, array $params = []): static
    {
        $viewPath = PATH_VIEW . $viewName;
        if (!file_exists($viewPath)) {
            throw new \Exception('Not found page 404');
        }

        return new static($viewPath, $params);
    }

    public function render(): string
    {
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        require_once $this->viewPath;

        return (string) ob_get_clean();
    }

    public function __tostring(): string
    {
        return $this->render();
    }
}