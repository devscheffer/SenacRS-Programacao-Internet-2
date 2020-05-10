<?php

namespace FastRoute\Dispatcher;

class GroupCountBased extends RegexBasedAbstract
{
    public function __construct($data)
    {
        list($this->staticRouteMap, $this->variableRoutedata) = $data;
    }

    protected function dispatchVariableRoute($routedata, $uri)
    {
        foreach ($routedata as $data) {
            if (!preg_match($data['regex'], $uri, $matches)) {
                continue;
            }

            list($handler, $varNames) = $data['routeMap'][count($matches)];

            $vars = [];
            $i = 0;
            foreach ($varNames as $varName) {
                $vars[$varName] = $matches[++$i];
            }
            return [self::FOUND, $handler, $vars];
        }

        return [self::NOT_FOUND];
    }
}
