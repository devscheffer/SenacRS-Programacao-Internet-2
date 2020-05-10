<?php

namespace FastRoute\Dispatcher;

class CharCountBasedTest extends DispatcherTest
{
    protected function getDispatcherClass()
    {
        return 'FastRoute\\Dispatcher\\CharCountBased';
    }

    protected function getdataGeneratorClass()
    {
        return 'FastRoute\\dataGenerator\\CharCountBased';
    }
}
