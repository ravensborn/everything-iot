<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetTeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            [
                'order' => 1,
                'name' => 'Karzan Ali Awla',
                'position' => 'Founder / CEO',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, iste.',
                'links' => [
                    [
                        'icon' => 'bi-facebook',
                        'url' => route('about'),
                    ],
                    [
                        'icon' => 'bi-linkedin',
                        'url' => route('about'),
                    ],

                ],
                'image' => public_path('images/wallpapers/team-members/1.png'),
                'is_visible' => true,
            ],
            [
                'order' => 2,
                'name' => 'Sameer Akram',
                'position' => 'System Admin',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, iste.',
                'links' => [
                    [
                        'icon' => 'bi-facebook',
                        'url' => route('about'),
                    ],
                    [
                        'icon' => 'bi-linkedin',
                        'url' => route('about'),
                    ],

                ],
                'image' => public_path('images/wallpapers/team-members/2.png'),
                'is_visible' => true,
            ],
            [
                'order' => 3,
                'name' => 'Van Nawzad',
                'position' => 'HR & Admin',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, iste.',
                'links' => [
                    [
                        'icon' => 'bi-facebook',
                        'url' => route('about'),
                    ],
                    [
                        'icon' => 'bi-linkedin',
                        'url' => route('about'),
                    ],

                ],
                'image' => public_path('images/wallpapers/team-members/4.png'),
                'is_visible' => true,
            ],
            [
                'order' => 4,
                'name' => 'Mohammed Hassan',
                'position' => 'Executive Assistance',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, iste.',
                'links' => [
                    [
                        'icon' => 'bi-facebook',
                        'url' => route('about'),
                    ],
                    [
                        'icon' => 'bi-linkedin',
                        'url' => route('about'),
                    ],

                ],
                'image' => public_path('images/wallpapers/team-members/5.png'),
                'is_visible' => true,
            ],
            [
                'order' => 5,
                'name' => 'Amina Khurshid',
                'position' => 'Programmer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, iste.',
                'links' => [
                    [
                        'icon' => 'bi-facebook',
                        'url' => route('about'),
                    ],
                    [
                        'icon' => 'bi-linkedin',
                        'url' => route('about'),
                    ],

                ],
                'image' => public_path('images/wallpapers/team-members/6.png'),
                'is_visible' => true,
            ]
        ];

        foreach ($members as $member) {

            $teamMember = TeamMember::create([
                'order' => $member['order'],
                'name' => $member['name'],
                'position' => $member['position'],
                'description' => $member['description'],
                'links' => $member['links'],
                'is_visible' => $member['is_visible']
            ]);

            $teamMember->addMedia($member['image'])
                ->preservingOriginal()
                ->toMediaCollection('image');
        }
    }
}
