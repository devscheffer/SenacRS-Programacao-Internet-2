<?php

namespace FastRoute\dataGenerator;

use FastRoute\BadRouteException;
use FastRoute\dataGenerator;
use FastRoute\Route;

abstract class RegexBasedAbstract implements dataGenerator
{
    /** @var mixed[][] */
    protected $staticRoutes = [];

    /** @var Route[][] */
    protected $methodToRegexToRoutesMap = [];

    /**
     * @return int
     */
    abstract protected function getApproxChunkSize();

    /**
     * @return mixed[]
     */
    abstract protected function processChunk($regexToRoutesMap);

    public function addRoute($httpMethod, $routedata, $handler)
    {
        if ($this->isStaticRoute($routedata)) {
            $this->addStaticRoute($httpMethod, $routedata, $handler);
        } else {
            $this->addVariableRoute($httpMethod, $routedata, $handler);
        }
    }

    /**
     * @return mixed[]
     */
    public function getdata()
    {
        if (empty($this->methodToRegexToRoutesMap)) {
            return [$this->staticRoutes, []];
        }

        return [$this->staticRoutes, $this->generateVariableRoutedata()];
    }

    /**
     * @return mixed[]
     */
    private function generateVariableRoutedata()
    {
        $data = [];
        foreach ($this->methodToRegexToRoutesMap as $method => $regexToRoutesMap) {
            $chunkSize = $this->computeChunkSize(count($regexToRoutesMap));
            $chunks = array_chunk($regexToRoutesMap, $chunkSize, true);
            $data[$method] = array_map([$this, 'processChunk'], $chunks);
        }
        return $data;
    }

    /**
     * @param int
     * @return int
     */
    private function computeChunkSize($count)
    {
        $numParts = max(1, round($count / $this->getApproxChunkSize()));
        return (int) ceil($count / $numParts);
    }

    /**
     * @param mixed[]
     * @return bool
     */
    private function isStaticRoute($routedata)
    {
        return count($routedata) === 1 && is_string($routedata[0]);
    }

    private function addStaticRoute($httpMethod, $routedata, $handler)
    {
        $routeStr = $routedata[0];

        if (isset($this->staticRoutes[$httpMethod][$routeStr])) {
            throw new BadRouteException(sprintf(
                'Cannot register two routes matching "%s" for method "%s"',
                $routeStr, $httpMethod
            ));
        }

        if (isset($this->methodToRegexToRoutesMap[$httpMethod])) {
            foreach ($this->methodToRegexToRoutesMap[$httpMethod] as $route) {
                if ($route->matches($routeStr)) {
                    throw new BadRouteException(sprintf(
                        'Static route "%s" is shadowed by previously defined variable route "%s" for method "%s"',
                        $routeStr, $route->regex, $httpMethod
                    ));
                }
            }
        }

        $this->staticRoutes[$httpMethod][$routeStr] = $handler;
    }

    private function addVariableRoute($httpMethod, $routedata, $handler)
    {
        list($regex, $variables) = $this->buildRegexForRoute($routedata);

        if (isset($this->methodToRegexToRoutesMap[$httpMethod][$regex])) {
            throw new BadRouteException(sprintf(
                'Cannot register two routes matching "%s" for method "%s"',
                $regex, $httpMethod
            ));
        }

        $this->methodToRegexToRoutesMap[$httpMethod][$regex] = new Route(
            $httpMethod, $handler, $regex, $variables
        );
    }

    /**
     * @param mixed[]
     * @return mixed[]
     */
    private function buildRegexForRoute($routedata)
    {
        $regex = '';
        $variables = [];
        foreach ($routedata as $part) {
            if (is_string($part)) {
                $regex .= preg_quote($part, '~');
                continue;
            }

            list($varName, $regexPart) = $part;

            if (isset($variables[$varName])) {
                throw new BadRouteException(sprintf(
                    'Cannot use the same placeholder "%s" twice', $varName
                ));
            }

            if ($this->regexHasCapturingGroups($regexPart)) {
                throw new BadRouteException(sprintf(
                    'Regex "%s" for parameter "%s" contains a capturing group',
                    $regexPart, $varName
                ));
            }

            $variables[$varName] = $varName;
            $regex .= '(' . $regexPart . ')';
        }

        return [$regex, $variables];
    }

    /**
     * @param string
     * @return bool
     */
    private function regexHasCapturingGroups($regex)
    {
        if (false === strpos($regex, '(')) {
            // Needs to have at least a ( to contain a capturing group
            return false;
        }

        // Semi-accurate detection for capturing groups
        return (bool) preg_match(
            '~
                (?:
                    \(\?\(
                  | \[ [^\]\\\\]* (?: \\\\ . [^\]\\\\]* )* \]
                  | \\\\ .
                ) (*SKIP)(*FAIL) |
                \(
                (?!
                    \? (?! <(?![!=]) | P< | \' )
                  | \*
                )
            ~x',
            $regex
        );
    }
}
