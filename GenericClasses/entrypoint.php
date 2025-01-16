<?php
namespace GenericClasses;

class EntryPoint
{
    public function __construct(public \IJDB\Routes $routes)
    {
    }
    public function run()
    {
        $pageName = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
        $page = $this->routes->getPage($pageName);
        $sidebar = $page['sidebar'] ?? null;
        $pageTitle = $page['title'];
        $layoutVar = $this->routes->getLayout();
        $layoutVar['pageTitle'] = $page['title'];
        $layoutVar['sidebar'] = $page['sidebar'];
        $layoutVar['subTitle'] = $page['subTitle'] ?? ''; // Ensure subTitle is set
        $layoutVar['display'] = $this->loadTemplate($page['tempName'], $page['variables']);
        echo $this->loadTemplate('../newsTemplates/layout.html.php', $layoutVar);
    }

    public function loadTemplate($fileName, $templateVars)
    {
        extract($templateVars);
        ob_start();
        require $fileName;
        $contents = ob_get_clean();
        return $contents;
    }
}