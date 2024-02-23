<div>

    <p>List of available roles and the roles marked in green are assigned to this user, you can assign a role to this user by clicking on
        the role name.</p>
    @foreach(\Spatie\Permission\Models\Role::all() as $role)
        <button


            @class(['btn','btn-light' => !(in_array( $role->name, $userRoles)), 'btn-success' => (in_array($role->name, $userRoles))])
            wire:click="toggleRole('{{ $role->name }}')"
        >
           @if(in_array( $role->name, $userRoles))
                <i class="bi bi-check2 me-1"></i>
            @else
                <i class="bi bi-dash me-1"></i>
            @endif

               {{ $role->name }}
        </button>
    @endforeach


</div>
