<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $services = [
            [
                'title' => 'Full Service ISP',
                'cover_url' => public_path('images/wallpapers/31.jpg'),
                'short_content' => 'TimeNet is a modern way, full-service ISP, offering Internet access, and network-related professional solutions.',
                'content' => '
                        <p class="card-text">
                            TimeNet is a modern way, full-service ISP, offering Internet access, and network-related
                            professional solutions.
                        </p>
                        <ul class="list-pointer mb-0">
                            <li class="list-pointer-item">Design.</li>
                            <li class="list-pointer-item">Installation and Management Network</li>
                            <li class="list-pointer-item">Fiber Optics, VoIP, and Surveillance systems</li>
                            <li class="list-pointer-item">Network, Access doors</li>
                        </ul>
                        ',
            ],
            [
                'title' => 'High Quality Support',
                'cover_url' => public_path('images/wallpapers/22.jpg'),
                'short_content' => 'TimeNet makes a concerted effort to keep customers informed and to remedy problems in the shortest possible times, and will continue to make high quality support one of its primary goals.',
                'content' => '
                        <p class="card-text">
                            TimeNet makes a concerted effort to keep customers informed and to remedy problems in the
                            shortest possible times, and will continue to make high quality support one of its primary
                            goals.
                        </p>
                        <ul class="list-pointer mb-0">
                            <li class="list-pointer-item">Open Ticket System</li>
                            <li class="list-pointer-item">Email and Phone Calling</li>
                            <li class="list-pointer-item">24/7 Availability</li>
                        </ul>
                        ',
            ],
            [
                'title' => 'Security Appliances & Firewalls',
                'cover_url' => public_path('images/wallpapers/10.jpg'),
                'short_content' => 'Discover an easier way to manage network security of your organization.',
                'content' => '
                        <p class="card-text">Provides an easier way to manage network security of your organization.</p>
                        <ul class="list-pointer mb-0">
                            <li class="list-pointer-item">Enterprise Technology</li>
                            <li class="list-pointer-item">Private Equity</li>
                            <li class="list-pointer-item">Sustainability</li>
                        </ul>
                ',
            ],
            [
                'title' => 'Availability',
                'cover_url' => public_path('images/wallpapers/10.jpg'),
                'short_content' => 'TimeNet has it is own autonomous system number (ASN) and own IP Public Address, plus a redundant gateway to different IGW to assure high availability in case of outage from one of the IGWs in the region.',
                'content' => '
                          <p class="card-text">
                            TimeNet has it is own autonomous system number (ASN) and own IP Public Address, plus a
                            redundant gateway to different IGW to assure high availability in case of outage from one of
                            the IGWs in the region.
                        </p>
                        ',
            ],
            [
                'title' => 'Future Services',
                'cover_url' => public_path('images/wallpapers/22.jpg'),
                'short_content' => 'TimeNet is in the process of researching a future service of integrated data over high speed TCP/IP network connections by increasing number of towers and connecting all of them by fiber optic by ring topology to assure service availability.',
                'content' => '
                         <p class="card-text">
                            TimeNet is in the process of researching a future service of integrated data over high speed TCP/IP network connections by increasing number of towers and connecting all of them by fiber optic by ring topology to assure service availability.
                        </p>
                        ',
            ],
            [
                'title' => 'Network Monitoring',
                'cover_url' => public_path('images/wallpapers/31.jpg'),
                'short_content' => '  The PRTG software utilized by TimeNet to monitor customers and we can create an individual account for every customer to monitor their internet connectivity.',
                'content' => '
                        <p class="card-text">
                            The PRTG software utilized by TimeNet to monitor customers and we can create an individual account for every customer to monitor their internet connectivity.
                        </p>
                ',
            ]
        ];

        foreach ($services as $post) {

            $saved_post = \App\Models\Post::factory()->create(
                [
                    'author_id' => 1,
                    'category_id' => 2,
                    'title' => $post['title'],
                    'content' => $post['content'],
                    'short_content' => $post['short_content'],
                ]
            );

            $saved_post->addMedia($post['cover_url'])
                ->preservingOriginal()
                ->toMediaCollection('cover');
        }

    }
}
