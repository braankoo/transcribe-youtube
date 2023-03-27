<?php

namespace Branko\Transcriby\Pipeline;

use FFMpeg\Format\Audio\Mp3;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

/**
 *
 */
class ConvertToMp3
{

    /**
     * @var string
     */
    private string $file;

    /**
     *
     */
    public function __construct()
    {
        $this->file = Str::random(10) . '.mp3';
    }

    /**
     * @param string $url
     * @param $next
     * @return mixed
     */
    public function handle(string $url, $next): string
    {

        FFMpeg::openUrl($url)
            ->export()
            ->inFormat(new Mp3())
            ->toDisk('local')
            ->save($this->file);
        return $next($this->file);
    }
}
