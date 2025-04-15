<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\NotFoundException;

class View
{
    protected string $viewPath;
    protected array $params;

    protected string $layoutPath;

    public function __construct(string $viewPath, array $params, string $layoutPath)
    {
        $this->viewPath = $viewPath;
        $this->params = $params;
        $this->layoutPath = $layoutPath;
    }

    public static function make(string $viewName, array $params = [], string $layoutName): static
    {
        $viewPath = PATH_VIEW . $viewName;
        $layoutPath = PATH_VIEW . $layoutName;
        if (!file_exists($viewPath) || !file_exists(filename: $layoutPath)) {
            throw new NotFoundException();
        }

        return new static($viewPath, $params, $layoutPath);
    }

    public function render(): string
    {
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        require_once $this->viewPath;

        $content = ob_get_clean();

        require_once $this->layoutPath;

        return (string) ob_get_clean();
    }

    public function __tostring(): string
    {
        return $this->render();
    }
}