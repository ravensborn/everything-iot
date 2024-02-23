<?php

namespace App\Http\Livewire\Dashboard\TeamMembers;

use App\Models\TeamMember;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public string $name = '';
    public string $position = '';
    public string $description = '';
    public bool $is_visible = false;
    public array $links = [];
    public $photo = '';

    public array $requiredLinks = [
        [
            'display_name' => 'E-Mail Address',
            'field_name' => 'email',
        ],
        [
            'display_name' => 'LinkedIn',
            'field_name' => 'linkedin',
        ]
    ];


    public function create()
    {

        $rules = [
            'name' => 'required|string|min:1|max:50',
            'position' => 'required|string|min:1|max:50',
            'description' => 'required|string|min:1|max:5000',
            'is_visible' => 'required|sometimes',
            'links' => 'required|array',
            'links.*.url' => 'required|string',
            'links.*.icon' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];

        $validated = $this->validate($rules);

        $order = 1;

        $firstTeamMember = TeamMember::orderBy('order', 'desc')->first();

        if ($firstTeamMember) {
            $order = $firstTeamMember->order + 1;
        }

        $validated['order'] = $order;

        $teamMember = new TeamMember;
        $teamMember = $teamMember->create($validated);


        if ($this->photo) {

            $name = time() . '_' . Str::random(5);

            $teamMember->addMedia($this->photo)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->photo->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        return redirect()->route('dashboard.team-members.index');

    }

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.team-members.create');
    }
}
