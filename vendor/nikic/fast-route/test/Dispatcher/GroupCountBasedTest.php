<?php

namespace FastRoute\Dispatcher;

class GroupCountBasedTest extends DispatcherTest
{
    protected function getDispatcherClass()
    {
        return 'FastRoute\\Dispatcher\\GroupCountBased';
    }

    protected function getdataGeneratorClass()
    {
        return 'FastRoute\\dataGenerator\\GroupCountBased';
    }
}
