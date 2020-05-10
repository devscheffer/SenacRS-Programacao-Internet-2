<?php

namespace FastRoute\Dispatcher;

class GroupPosBasedTest extends DispatcherTest
{
    protected function getDispatcherClass()
    {
        return 'FastRoute\\Dispatcher\\GroupPosBased';
    }

    protected function getdataGeneratorClass()
    {
        return 'FastRoute\\dataGenerator\\GroupPosBased';
    }
}
