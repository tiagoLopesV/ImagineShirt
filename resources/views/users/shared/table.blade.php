<table class="table">
    <thead class="table-dark">
        <tr>
                <th></th>
            <th>Nome</th>
            <th>Tipo</th>
            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="{{ $user->blocked == 1 ? 'blocked-row' : '' }}">
                    <td width="45">
                    <img src="{{$user->fullPhotoUrl}}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                    </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user_type }}</td>
                <td class="button-icon-col"><a href="{{ route('users.show', ['user' => $user]) }}"
                            class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                <td class="button-icon-col"><a href="{{ route('users.edit', ['user' => $user]) }}"
                            class="btn btn-dark"><i class="fas fa-edit"></i></a></td>
                <td class="button-icon-col">
                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal">
                            <i class="fas fa-trash"></i></button>
                </td>    
            </tr>
        @endforeach
    </tbody>
</table>
