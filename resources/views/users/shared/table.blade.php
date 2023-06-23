<table class="table">
    <thead class="table-dark">
        <tr>
                <th></th>
            <th>Nome</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                    <td width="45">
                    <img src="{{$user->fullPhotoUrl}}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                    </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user_type }}</td>

                
            </tr>
        @endforeach
    </tbody>
</table>
