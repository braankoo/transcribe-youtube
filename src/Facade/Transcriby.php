<?php

namespace Branko\Transcriby\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string youtube(string $videoId)
 */
class Transcriby extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'transcriby';
    }

}
