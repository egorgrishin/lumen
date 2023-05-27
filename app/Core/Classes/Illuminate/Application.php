<?php

namespace Core\Classes\Illuminate;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Laravel\Lumen\Application as LumenApplication;

class Application extends LumenApplication
{
    /**
     * Get the path to the given configuration file.
     *
     * If no name is provided, then we'll return the path to the config folder.
     *
     * @param string|null $name
     * @return string
     *
     * @throws FileNotFoundException
     */
    public function getConfigurationPath($name = null): string
    {
        $path = $this->basePath('app/Core/Configs') . ($name ? "/$name.php" : '/');
        if (file_exists($path)) {
            return $path;
        }
        throw new FileNotFoundException("Directory [$path] not found");
    }
}
