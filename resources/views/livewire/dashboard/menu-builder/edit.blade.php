<div>

    <div class="row">

        <div class="col-12 col-md-6">
            <div>
                <label for="menu_item_type" class="form-label">Menu Item Type</label>
                <select id="menu_item_type" class="form-control" wire:model="menuItemType">
                    <option value="">-- Select Item --</option>
                    @foreach($menuTypesArray as $item)
                        <option value="{{ $item }}"> {{ ucwords(str_replace('_', ' ', $item)) }} </option>
                    @endforeach
                </select>
            </div>
            @if(in_array($menuItemType, $menuTypesArray))
                <div class="mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" wire:model="name">
                </div>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endif
            @if(in_array($menuItemType, [\App\Models\Menu::ITEM_TYPE_POST_DROPDOWN, \App\Models\Menu::ITEM_TYPE_ROUTE_DROPDOWN, \App\Models\Menu::ITEM_TYPE_LINK_DROPDOWN]))
                <div class="mt-3">
                    @for($i = 0; $i < $dropdownItemNumberCount; $i++)
                        <div class="mt-2">

                            <div class="row">
                                <div class="col-2">
                                    <div class="h-100 d-flex align-items-end">
                                        <div class="fw-bold"># Item {{ $i+1 }}</div>
                                    </div>

                                </div>
                                <div class="col-5">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control"
                                           wire:model="dropdownItemArray.{{ $i }}.name" wire:key="{{ $i }}">
                                    @error('dropdownItemArray.'. $i .'.name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-5">
                                    <label for="destination" class="form-label">
                                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_POST_DROPDOWN)
                                            Post slug name
                                        @endif
                                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_ROUTE_DROPDOWN)
                                            Route name
                                        @endif
                                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_LINK_DROPDOWN)
                                            URL
                                        @endif
                                    </label>
                                    <input type="text" id="destination" class="form-control"
                                           wire:model="dropdownItemArray.{{ $i }}.destination" wire:key="{{ $i }}">
                                    @error('dropdownItemArray.'. $i .'.destination')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="row">
                        <div class="col">
                            <hr>
                            <button class="btn btn-primary" wire:click="addNewField()">
                                <i class="bi bi-plus"></i>
                                Add Field
                            </button>
                            @if($dropdownItemNumberCount > 1)
                                <button class="btn btn-secondary" wire:click="removeField()">
                                    <i class="bi bi-x"></i>
                                    Remove Field
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if(in_array($menuItemType, [\App\Models\Menu::ITEM_TYPE_POST, \App\Models\Menu::ITEM_TYPE_ROUTE, \App\Models\Menu::ITEM_TYPE_ROUTE_STYLED, \App\Models\Menu::ITEM_TYPE_LINK, \App\Models\Menu::ITEM_TYPE_CALL_US_BTN]))
                <div class="mt-3">
                    <label for="destination" class="form-label">
                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_POST)
                            Post slug name
                        @endif
                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_ROUTE)
                            Route name
                        @endif
                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_ROUTE_STYLED)
                            Route name
                        @endif
                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_LINK)
                            URL
                        @endif
                        @if($menuItemType == \App\Models\Menu::ITEM_TYPE_CALL_US_BTN)
                            Telephone Number
                        @endif
                    </label>
                    <input type="text" id="destination" class="form-control" wire:model="destination">
                    @error('destination')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <div class="mt-3">
                <hr>
                <button class="btn btn-primary" wire:click="addItem">
                    <i class="bi bi-check2"></i>
                    Save Menu Item
                </button>
            </div>
        </div>

        <div class="col-12 col-md-6">

            <div class="mt-3 mt-md-0">

            </div>

            @forelse($items as $index => $item)

                @if(in_array($item['type'], [App\Models\Menu::ITEM_TYPE_ROUTE, App\Models\Menu::ITEM_TYPE_ROUTE_STYLED, App\Models\Menu::ITEM_TYPE_LINK, App\Models\Menu::ITEM_TYPE_POST]))
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>
                                    <span>
                                        <a target="_blank" href="{{ $item['url'] }}">{!! $item['name'] !!}</a>
                                    </span>
                                    -
                                    <small class="badge bg-secondary">{{ $item['type'] }}</small>
                                </div>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if(in_array($item['type'], [App\Models\Menu::ITEM_TYPE_ROUTE_DROPDOWN, App\Models\Menu::ITEM_TYPE_LINK_DROPDOWN, App\Models\Menu::ITEM_TYPE_POST_DROPDOWN]))
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>
                                    <span>{!! $item['name'] !!}</span>
                                    -
                                    <small class="badge bg-secondary">{{ $item['type'] }}</small>
                                </div>
                                <div class="mt-2">
                                    <ul>
                                        @foreach($item['array'] as $sub)
                                            <li>
                                                <a target="_blank" href="{{ $sub['url'] }}">{{ $sub['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if($item['type'] == \App\Models\Menu::ITEM_TYPE_USER_ACCOUNT)
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                User Account ( {!! $item['name'] !!} )
                                <small class="badge bg-secondary">{{ $item['type'] }}</small>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if($item['type'] == \App\Models\Menu::ITEM_TYPE_LANG_SWITCHER)
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                Language Switcher ( {!! $item['name'] !!} )
                                <small class="badge bg-secondary">{{ $item['type'] }}</small>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if($item['type'] == \App\Models\Menu::ITEM_TYPE_CALL_US_BTN)
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                Call TimeNet Button ( {!! $item['name'] !!} )
                                <small class="badge bg-secondary">{{ $item['type'] }}</small>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if($item['type'] == \App\Models\Menu::ITEM_TYPE_LIVEWIRE_CART)
                    <div class="shadow border rounded p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                Mini Cart Icon
                                <small class="badge bg-secondary">{{ $item['type'] }}</small>
                            </div>
                            <div>
                                @if ($index > 0)
                                    <button wire:click="moveUp({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-up"></i></button>
                                @endif
                                @if ($index < count($items) - 1)
                                    <button wire:click="moveDown({{$index}})" wire:loading.attr="disabled"
                                            class="btn btn-sm btn-primary me-1"><i class="bi bi-arrow-down"></i>
                                    </button>
                                @endif
                                <button wire:click="triggerDeleteItem({{$index}})"
                                        wire:target="triggerDeleteItem({{$index}})" wire:loading.attr="disabled"
                                        class="btn btn-sm btn-danger me-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endif

            @empty
                There are no items in this menu, please add an item.
            @endforelse


        </div>

    </div>

    <div class="mt-3">
        <a href="{{ route('dashboard.menu-builder.index') }}">Return to list of menus.</a>
    </div>

</div>
