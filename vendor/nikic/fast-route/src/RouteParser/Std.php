<?php

namespace FastRoute\RouteParser;

use FastRoute\BadRouteException;
use FastRoute\RouteParser;

/**
 * Parses route strings of the following form:
 *
 * "/user/{name}[/{id:[0-9]+}]"
 */
class Std implements RouteParser
{
    const VARIABLE_REGEX = <<<'REGEX'
\{
    \s* ([a-zA-Z_][a-zA-Z0-9_-]*) \s*
    (?:
        : \s* ([^{}]*(?:\{(?-1)\}[^{}]*)*)
    )?
\}
REGEX;
    const DEFAULT_DISPATCH_REGEX = '[^/]+';

    public function parse($route)
    {
        $routeWithoutClosingOptionals = rtrim($route, ']');
        $numOptionals = strlen($route) - strlen($routeWithoutClosingOptionals);

        // Split on [ while skipping placeholders
        $segments = preg_split('~' . self::VARIABLE_REGEX . '(*SKIP)(*F) | \[~x', $routeWithoutClosingOptionals);
        if ($numOptionals !== count($segments) - 1) {
            // If there are any ] in the middle of the route, throw a more specific error message
            if (preg_match('~' . self::VARIABLE_REGEX . '(*SKIP)(*F) | \]~x', $routeWithoutClosingOptionals)) {
                throw new BadRouteException('Optional segments can only occur at the end of a route');
            }
            throw new BadRouteException("Number of opening '[' and closing ']' does not match");
        }

        $currentRoute = '';
        $routedatas = [];
        foreach ($segments as $n => $segment) {
            if ($segment === '' && $n !== 0) {
                throw new BadRouteException('Empty optional part');
            }

            $currentRoute .= $segment;
            $routedatas[] = $this->parsePlaceholders($currentRoute);
        }
        return $routedatas;
    }

    /**
     * Parses a route string that does not contain optional segments.
     *
     * @param string
     * @return mixed[]
     */
    private function parsePlaceholders($route)
    {
        if (!preg_match_all(
            '~' . self::VARIABLE_REGEX . '~x', $route, $matches,
            PREG_OFFSET_CAPTURE | PREG_SET_ORDER
        )) {
            return [$route];
        }

        $offset = 0;
        $routedata = [];
        foreach ($matches as $set) {
            if ($set[0][1] > $offset) {
                $routedata[] = substr($route, $offset, $set[0][1] - $offset);
            }
            $routedata[] = [
                $set[1][0],
                isset($set[2]) ? trim($set[2][0]) : self::DEFAULT_DISPATCH_REGEX
            ];
            $offset = $set[0][1] + strlen($set[0][0]);
        }

        if ($offset !== strlen($route)) {
            $routedata[] = substr($route, $offset);
        }

        return $routedata;
    }
}
