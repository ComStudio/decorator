<?php

declare(strict_types=1);

namespace Acme\Helper;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class ThumbnailFromVideo
{
    public function create(File $file)
    {
        $path = $file->getPath();

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => config('ffmpeg.ffmpeg'),
            'ffprobe.binaries' => config('ffmpeg.ffprobe'),
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);

        $video = $ffmpeg->open($path);

        $ffprobe = FFProbe::create([
            'ffmpeg.binaries'  => config('ffmpeg.ffmpeg'),
            'ffprobe.binaries' => config('ffmpeg.ffprobe'),
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);

        $duration = $ffprobe
            ->format($path) // extracts file informations
            ->get('duration');

        $diffDuration = $duration / 5;
        $thumbExt = '.jpg';

        $name = $file->getName() . '_thumb' . $thumbExt;

        $frame = $video
            ->frame(TimeCode::fromSeconds($diffDuration * 2));
        $frame
            ->save($file->getFullPath() . $name);

        return \File::get($file->getFullPath() . $name);
    }
}
