<?php

namespace Branko\Transcriby\Pipeline;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SendToOpenAI
{
    /**
     *
     * @throws Exception
     */
    public function handle(string $file, $next): string
    {

        $data = new UploadedFile(Storage::disk('local')->path($file), $file);
        $response = $this->postRequest($data, $file);
        Storage::disk('local')->delete($file);
        if ($response->ok()) {
            return $next($response['text']);
        } else {
            Log::error($response->json());
            throw new Exception('Error Ocured while sending data to Open ai');
        }


    }

    /**
     * @param UploadedFile $data
     * @param string $file
     * @return PromiseInterface|Response
     */
    private function postRequest(UploadedFile $data, string $file): Response|PromiseInterface
    {
        return Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . config('transcriby')['openAiToken'],
            ]
        )->attach('file', file_get_contents($data), $file)
            ->post(
                'https://api.openai.com/v1/audio/transcriptions',
                [
                    'model' => 'whisper-1',
                ]
            );
    }
}
