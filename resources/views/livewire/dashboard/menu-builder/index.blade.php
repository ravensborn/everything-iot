<div>


   <table class="table table-striped table-sm table-bordered">
       <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Actions</th>
        </tr>
       </thead>
       <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->code }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ route('dashboard.menu-builder.edit', $menu->id) }}">
                            <i class="bi bi-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
       </tbody>

   </table>

</div>
