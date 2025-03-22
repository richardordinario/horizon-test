<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = [
            [
                "title" => "17-3-2024 Bon choix de sa vie loin de son ame soeur",
                "artist" => "Chacals84",
                "file_url" => "https://cdn.pixabay.com/audio/2024/03/18/audio_b71ef0cb1f.mp3",
            ],
            [
                "title" => "Space Vender (Remastered)",
                "artist" => "Magiksolo",
                "file_url" => "https://cdn.pixabay.com/audio/2024/08/04/audio_092f034143.mp3",
            ],
            [
                "title" => "Future Blast (Remastered)",
                "artist" => "Magiksolo",
                "file_url" => "https://cdn.pixabay.com/audio/2024/08/04/audio_5c586b7328.mp3",
            ],
            [
                "title" => "Burnt links",
                "artist" => "SoulVital",
                "file_url" => "https://cdn.pixabay.com/audio/2024/09/27/audio_76d3766196.mp3",
            ],
            [
                "title" => "Charred Links",
                "artist" => "Albert-Paul",
                "file_url" => "https://cdn.pixabay.com/audio/2024/07/08/audio_2f9ba1aa00.mp3",
            ],
            [
                "title" => "Summer Vibes",
                "artist" => "Mike Leite",
                "file_url" => "https://www.bensound.com/bensound-music/bensound-summer.mp3",
            ],
            [
                "title" => "Jazz Comedy",
                "artist" => "Bensound",
                "file_url" => "https://www.bensound.com/bensound-music/bensound-jazzcomedy.mp3",
            ],
            [
                "title" => "Jazzy Frenchy",
                "artist" => "Bensound",
                "file_url" => "https://www.bensound.com/bensound-music/bensound-jazzyfrenchy.mp3",
            ],
            [
                "title" => "Funky Suspense",
                "artist" => "Bensound",
                "file_url" => "https://www.bensound.com/bensound-music/bensound-funkysuspense.mp3",
            ],
            [
                "title" => "Funky Element",
                "artist" => "Bensound",
                "file_url" => "https://www.bensound.com/bensound-music/bensound-funkyelement.mp3",
            ]

        ];

        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
