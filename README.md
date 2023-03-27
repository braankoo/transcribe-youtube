<h2>Installation</h2>
<p>To install Transcriby, simply require the package using Composer:</p>
<code>composer require branko/transcriby</code>

<p>Next, add the service provider to your <code>config/app.php</code> file:</p>

<code>
    'providers' => [
        Branko\Transcriby\Providers\TranscribyServiceProvider::class
    ]
</code>

<p>You can also add the facade to your <code>config/app.php</code> file:</p>

<code>
'aliases' => ['Transcriby' => Branko\Transcriby\Facade\Transcriby::class],
</code>

<p>Finally, publish the package configuration file using Artisan:</p>

<code>php artisan vendor:publish --provider="Branko\Transcriby\Providers\TranscribyServiceProvider" --tag="config"</code>

<h2>Usage</h2>

<p>To transcribe a YouTube video, simply call the <code>youtube</code> method on the <code>Transcriby</code> facade:</p>

<code>$text = Transcriby::youtube('https://www.youtube.com/watch?v=9azXvuCtodM&ab_channel=JRE%2B');</code>

<p>This will return the transcription of the video as a string.</p>

<h2>Configuration</h2>

<p>You can configure Transcriby by editing the <code>config/transcriby.php</code> file that was published to your application's config directory.</p>

<h2>License</h2>

<p>Transcriby is open-sourced software licensed under the MIT license.</p>
