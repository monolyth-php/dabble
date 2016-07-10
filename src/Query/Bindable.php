<?php

namespace Monolyth\Dabble\Query;

interface Bindable
{
    public function getBindings();
    public function prepareBindings(array $data);
}

