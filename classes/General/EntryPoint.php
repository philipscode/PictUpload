<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/13/18
 * Time: 10:28 AM
 */


namespace General;


class EntryPoint
{
    private $route;
    private $method;
    private $routes;

    public function __construct(string $route, string $method, \Specific\Routes $routes)
    {
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
    }

    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);

        ob_start();
        include __DIR__.'/../../templates/' . $templateFileName;

        return ob_get_clean();
    }

    public function run()
    {
        $this->checkUrl();

        $routes = $this->routes->getRoutes();

        $authentication = $this->routes->getAuthentication();

        if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
            header('location: /login/error');
        } else {

            $controller = $routes[$this->route][$this->method]['controller'];
            $action = $routes[$this->route][$this->method]['action'];

            $page = $controller->$action();

            $title = $page['title'];

            if (isset($page['variables'])) {
                $output = $this->loadTemplate($page['template'], $page['variables']);
            } else {
                $output = $this->loadTemplate($page['template']);
            }

            echo $this->loadTemplate('layout.html.php',['loggedIn' => $authentication->isLoggedIn(),
                                                                        'output' => $output,
                                                                        'title' => $title]);
        }
    }
}