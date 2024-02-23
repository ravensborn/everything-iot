<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class TimeNetArticleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $articles = [
            [
                'title' => '11 Ways to Protect Your Computer From Viruses',
                'cover_url' => public_path('seeder/articles/1.jpg'),
                'short_content' => 'Whether you are connecting to the internet or not, having reliable protection is the route to go. Anti-virus programs are a minimal investment and are worth the dollars so as soon as you power up that computer, make sure you are protected!',
                'content' => public_path('seeder/articles/article1.txt'),
            ],
            [
                'title' => 'What Is Ransomware?',
                'cover_url' => public_path('seeder/articles/4.jpg'),
                'short_content' => 'Ransomware is malware that employs encryption to hold a victim’s information at ransom. A user or organization’s
    critical data is encrypted so that they cannot access files, databases, or applications.',
                'content' => public_path('seeder/articles/article2.txt'),
            ],

            [
                'title' => 'What is a point-to-point internet connection and what are the benefits?',
                'cover_url' => public_path('seeder/articles/5.jpg'),
                'short_content' => 'Today, most business activities and even the daily activities of individuals depend on the Internet, and a low-speed Internet service can have a great impact on the work of organizations and daily tasks.',
                'content' => public_path('seeder/articles/article3.txt'),
            ],

            [
                'title' => 'Dedicated VS. Shared',
                'cover_url' => public_path('seeder/articles/6.jpg'),
                'short_content' => 'When it comes to fiber optic internet, there are three distinct types of fiber delivery. There are also two distinct
    ways that Internet Service Providers (ISPs) connect your home to the network. You can be connected with shared
    fiber, or connected with dedicated fiber.',
                'content' => public_path('seeder/articles/article4.txt'),
            ],

            [
                'title' => 'What is a point-to-point internet connection and what are the benefits?',
                'cover_url' => public_path('seeder/articles/7.jpg'),
                'short_content' => 'Our world has been converted to digitization, resulting in modifications in nearly all our daily activities. All organizations want to protect their networks if the intention is to deliver the services demanded using employees and customers. ',
                'content' => public_path('seeder/articles/article5.txt'),
            ],

        ];


        foreach ($articles as $post) {

            $content = fopen($post['content'], "r") or die("Unable to open file!");
            $contentText = fread($content, filesize($post['content']));
            fclose($content);

            $saved_post = \App\Models\Post::factory()->create(
                [
                    'author_id' => 1,
                    'category_id' => 4,
                    'title' => $post['title'],
                    'content' => $contentText,
                    'short_content' => $post['short_content'],
                ]
            );

            $saved_post->addMedia($post['cover_url'])
                ->preservingOriginal()
                ->toMediaCollection('cover');
        }

    }
}
