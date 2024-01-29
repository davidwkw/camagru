<?php

declare(strict_types=1);

namespace Camagru;

class Template
{
    public string $templateDir;

    public function __construct(string $folder = null)
    {
        $this->templateDir = "";
        if ($folder) {
            $this->setTemplateDir($folder);
        }
    }

    public function setTemplateDir(string $folder): void
    {
        $this->templateDir = rtrim($folder, "/");
    }

    public function findTemplate(string|array $templateNames): string
    {
        if (!is_array($templateNames)) {
            $templateNames = [$templateNames];
        }

        $templateNames = array_reverse($templateNames);
        $found = "";
        foreach ($templateNames as $templateName) {
            $file = $this->templateDir . $templateName;
            if (is_file($file)) {
                $found = $file;
                break;
            }
        }
        return $found;
    }

    public function render(string|array $templateNames, array $args): string
    {
        $template = $this->findTemplate($templateNames);
        $output = "";
        if ($template) {
            $output = $this->renderTemplate($templateNames, $args);
        }
        return $output;
    }

    // using func_get_args prevents arguments from being accidentally overwritten
    public function renderTemplate(): string
    {
        ob_start();
        foreach (func_get_args()[1] as $k => $v) {
            ${$k} = $v;
        }
        include(func_get_args()[0]);
        return ob_get_clean();
    }
}
