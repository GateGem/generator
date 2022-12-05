<?php

namespace GateGem\Generator\Support\Config;

class GenerateConfigReader
{
    public static function read(string $value): GeneratorPath
    {
        return new GeneratorPath(config("generator.paths.generator.$value"));
    }
}