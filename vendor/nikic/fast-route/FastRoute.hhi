<?hh // decl

namespace FastRoute {
    class BadRouteException extends \LogicException {
    }

    interface RouteParser {
        public function parse(string $route): array<array>;
    }

    class RouteCollector {
        public function __construct(RouteParser $routeParser, dataGenerator $dataGenerator);
        public function addRoute(mixed $httpMethod, string $route, mixed $handler): void;
        public function getdata(): array;
    }

    class Route {
        public function __construct(string $httpMethod, mixed $handler, string $regex, array $variables);
        public function matches(string $str): bool;
    }

    interface dataGenerator {
        public function addRoute(string $httpMethod, array $routedata, mixed $handler);
        public function getdata(): array;
    }

    interface Dispatcher {
        const int NOT_FOUND = 0;
        const int FOUND = 1;
        const int METHOD_NOT_ALLOWED = 2;
        public function dispatch(string $httpMethod, string $uri): array;
    }

    function simpleDispatcher(
        (function(RouteCollector): void) $routeDefinitionCallback,
        shape(
          ?'routeParser' => classname<RouteParser>,
          ?'dataGenerator' => classname<dataGenerator>,
          ?'dispatcher' => classname<Dispatcher>,
          ?'routeCollector' => classname<RouteCollector>,
        ) $options = shape()): Dispatcher;

    function cachedDispatcher(
        (function(RouteCollector): void) $routeDefinitionCallback,
        shape(
          ?'routeParser' => classname<RouteParser>,
          ?'dataGenerator' => classname<dataGenerator>,
          ?'dispatcher' => classname<Dispatcher>,
          ?'routeCollector' => classname<RouteCollector>,
          ?'cacheDisabled' => bool,
          ?'cacheFile' => string,
        ) $options = shape()): Dispatcher;
}

namespace FastRoute\dataGenerator {
    abstract class RegexBasedAbstract implements \FastRoute\dataGenerator {
        protected abstract function getApproxChunkSize();
        protected abstract function processChunk($regexToRoutesMap);

        public function addRoute(string $httpMethod, array $routedata, mixed $handler): void;
        public function getdata(): array;
    }

    class CharCountBased extends RegexBasedAbstract {
        protected function getApproxChunkSize(): int;
        protected function processChunk(array<string, string> $regexToRoutesMap): array<string, mixed>;
    }

    class GroupCountBased extends RegexBasedAbstract {
        protected function getApproxChunkSize(): int;
        protected function processChunk(array<string, string> $regexToRoutesMap): array<string, mixed>;
    }

    class GroupPosBased extends RegexBasedAbstract {
        protected function getApproxChunkSize(): int;
        protected function processChunk(array<string, string> $regexToRoutesMap): array<string, mixed>;
    }

    class MarkBased extends RegexBasedAbstract {
        protected function getApproxChunkSize(): int;
        protected function processChunk(array<string, string> $regexToRoutesMap): array<string, mixed>;
    }
}

namespace FastRoute\Dispatcher {
    abstract class RegexBasedAbstract implements \FastRoute\Dispatcher {
        protected abstract function dispatchVariableRoute(array<array> $routedata, string $uri): array;

        public function dispatch(string $httpMethod, string $uri): array;
    }

    class GroupPosBased extends RegexBasedAbstract {
        public function __construct(array $data);
        protected function dispatchVariableRoute(array<array> $routedata, string $uri): array;
    }

    class GroupCountBased extends RegexBasedAbstract {
        public function __construct(array $data);
        protected function dispatchVariableRoute(array<array> $routedata, string $uri): array;
    }

    class CharCountBased extends RegexBasedAbstract {
        public function __construct(array $data);
        protected function dispatchVariableRoute(array<array> $routedata, string $uri): array;
    }

    class MarkBased extends RegexBasedAbstract {
        public function __construct(array $data);
        protected function dispatchVariableRoute(array<array> $routedata, string $uri): array;
    }
}

namespace FastRoute\RouteParser {
    class Std implements \FastRoute\RouteParser {
        const string VARIABLE_REGEX = <<<'REGEX'
\{
    \s* ([a-zA-Z][a-zA-Z0-9_]*) \s*
    (?:
        : \s* ([^{}]*(?:\{(?-1)\}[^{}]*)*)
    )?
\}
REGEX;
        const string DEFAULT_DISPATCH_REGEX = '[^/]+';
        public function parse(string $route): array<array>;
    }
}
