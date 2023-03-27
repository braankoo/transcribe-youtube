<?php

namespace Branko\Transcriby\Pipeline;


use YouTube\YouTubeDownloader;
use YouTube\Exception\TooManyRequestsException;
use YouTube\Exception\YouTubeException;

/**
 *
 */
class Download
{

    /**
     * @var YouTubeDownloader
     */
    private YouTubeDownloader $youtube;


    /**
     * @param YouTubeDownloader $youtube
     */
    public function __construct(YouTubeDownloader $youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * @throws YouTubeException
     * @throws TooManyRequestsException
     */
    public function handle(string $url, $next): string
    {

        $downloadOptions = $this->youtube->getDownloadLinks($url);

        if ($downloadOptions->getAllFormats()) {
            $url = $downloadOptions->getAudioFormats()[0]->url;
            return $next($url);
        } else {
            throw new YouTubeException('problem with video');
        }
    }
}
