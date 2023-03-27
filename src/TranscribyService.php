<?php

namespace Branko\Transcriby;

use Branko\Transcriby\Pipeline\ConvertToMp3;
use Branko\Transcriby\Pipeline\Download;
use Branko\Transcriby\Pipeline\SendToOpenAI;
use Illuminate\Support\Facades\Pipeline;

class TranscribyService
{
    public function youtube(string $url)
    {
        $data = Pipeline::send($url)
            ->through([
                Download::class,
                ConvertToMp3::class,
                SendToOpenAI::class,
            ])->thenReturn();
        return $data;
    }

}
