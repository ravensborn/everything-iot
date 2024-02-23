<?php

namespace App\Http\Livewire\Dashboard\MenuBuilder;

use App\Models\Menu;
use App\Models\Post;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public $menu;
    public array $items;
    public array $menuTypesArray = [];

    public string $name = '';
    public string $destination = '';
    public int $dropdownItemNumberCount = 3;
    public array $dropdownItemArray = [];

    public function addItem(): void
    {

        $this->resetValidation();
        $pass = true;

        if (!$this->menuItemType) {
            $pass = false;
        }

        $data = [];
        $data['array'] = [];

        if (in_array($this->menuItemType, $this->menuTypesArray)) {
            if (strlen($this->name) > 0) {
                $data['name'] = $this->name;
            } else {
                $this->addError('name', 'The name field is required.');
                $pass = false;
            }
        }

        if (in_array($this->menuItemType, [Menu::ITEM_TYPE_POST_DROPDOWN, Menu::ITEM_TYPE_ROUTE_DROPDOWN, Menu::ITEM_TYPE_LINK_DROPDOWN])) {

            $array = [];

            if (count($this->dropdownItemArray) > 0) {

                foreach ($this->dropdownItemArray as $index => $item) {

                    if (array_key_exists('name', $item) && strlen($item['name']) > 0) {
                        $array['name'] = $item['name'];
                    } else {
                        $this->addError('dropdownItemArray.'. $index .'.name', 'The name field is required.');
                        $pass = false;
                    }

                    if (array_key_exists('destination', $item) && strlen($item['destination']) > 0) {

                        if ($this->menuItemType == Menu::ITEM_TYPE_LINK_DROPDOWN) {
                            if (filter_var($item['destination'], FILTER_VALIDATE_URL)) {
                                $array['url'] = $item['destination'];
                            } else {
                                $this->addError('dropdownItemArray.'. $index .'.destination', 'Invalid URL.');
                                $pass = false;
                            }
                        }
                        if ($this->menuItemType == Menu::ITEM_TYPE_ROUTE_DROPDOWN) {
                            if (\Route::has($item['destination'])) {
                                $array['url'] = route($item['destination']);
                            } else {
                                $this->addError('dropdownItemArray.'. $index .'.destination', 'Invalid laravel route name.');
                                $pass = false;
                            }
                        }
                        if ($this->menuItemType == Menu::ITEM_TYPE_POST_DROPDOWN) {
                            $post = Post::where('slug', $item['destination'])->first();

                            if ($post) {
                                $array['url'] = route('posts.show', $post->slug);
                            } else {
                                $this->addError('dropdownItemArray.'. $index .'.destination', 'Invalid post slug name.');
                                $pass = false;
                            }
                        }
                    } else {

                        $this->addError('dropdownItemArray.'. $index .'.destination', 'The destination field is required.');
                        $pass = false;
                    }

                    if($pass) {
                        $data['array'][] = $array;
                    }
                }
            }

            if(count($data['array']) <= 0) {
                $pass = false;
//                $this->addError('genera_dropdown_error', 'You must at least add one item to the dropdown.');
            }

        }

        if ($this->menuItemType == Menu::ITEM_TYPE_POST) {

            $post = Post::where('slug', $this->destination)->first();

            if ($post) {
                $data['url'] = route('posts.show', $post->slug);
            } else {
                $this->addError('destination', 'Invalid post slug name.');
                $pass = false;
            }
        }

        if ($this->menuItemType == Menu::ITEM_TYPE_ROUTE) {

            if (\Route::has($this->destination)) {
                $data['url'] = route($this->destination);
            } else {
                $this->addError('destination', 'Invalid laravel route name.');
                $pass = false;
            }

        }

        if ($this->menuItemType == Menu::ITEM_TYPE_LINK) {

            if (filter_var($this->destination, FILTER_VALIDATE_URL)) {
                $data['url'] = $this->destination;
            } else {
                $this->addError('destination', 'Invalid URL.');
                $pass = false;
            }
        }

        if ($this->menuItemType == Menu::ITEM_TYPE_CALL_US_BTN) {

            if (strlen($this->destination) > 0) {
                $data['tel'] = $this->destination;
            } else {
                $this->addError('destination', 'Invalid telephone number.');
                $pass = false;
            }
        }


        if ($pass) {
            $data['type'] = $this->menuItemType;
            $this->items[] = $data;
            $this->saveItems();
            $this->alert('success', 'Successfully saved new item.');
            $this->name = '';
            $this->destination = '';
            $this->menuItemType = '';
            $this->dropdownItemNumberCount = 3;
        }
    }

    public function addNewField(): void
    {
        $this->dropdownItemNumberCount++;
    }

    public function removeField(): void
    {
        if ($this->dropdownItemNumberCount > 1) {
            $this->dropdownItemNumberCount--;
        }
    }

    public string $menuItemType = '';

    public function loadItems(): void
    {
        $this->items = $this->menu->items;
    }

    public function moveUp($index): void
    {
        if ($index > 0) {
            $temp = $this->items[$index];
            $this->items[$index] = $this->items[$index - 1];
            $this->items[$index - 1] = $temp;
        }
        $this->saveItems();
    }

    public function moveDown($index): void
    {
        if ($index < count($this->items) - 1) {
            $temp = $this->items[$index];
            $this->items[$index] = $this->items[$index + 1];
            $this->items[$index + 1] = $temp;
        }
        $this->saveItems();
    }

    public function saveItems(): void
    {

        //Resetting indexes.
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item;
        }

        //Saving
        $this->menu->update([
            'items' => $items
        ]);
    }

    public $indexToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem($indexToBeDeleted): void
    {
        $this->confirm('Are you sure that you want to delete this item?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'deleteItem'
        ]);

        $this->indexToBeDeleted = $indexToBeDeleted;
    }

    public function deleteItem(): void
    {
        if ($this->indexToBeDeleted >= 0) {

            unset($this->items[$this->indexToBeDeleted]);

            $this->saveItems();
        }

        $this->alert('success', 'Item successfully deleted.', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);

    }

    public function mount(Menu $menu): void
    {
        $this->menu = $menu;
        $this->menuTypesArray = Menu::menuItemsArray();
    }

    public function render()
    {
        $this->loadItems();
        return view('livewire.dashboard.menu-builder.edit');
    }
}
