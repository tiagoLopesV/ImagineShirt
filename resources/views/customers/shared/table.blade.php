<table class="table">
    <thead class="table-dark">
        <tr>
                <th></th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                    <td width="45">
                    <img src="{{ $customer->user->photo_url }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                    </td>
                <td>{{ $customer->user->name }}</td>
                <td>{{ $customer->nif }}</td>

                
            </tr>
        @endforeach
    </tbody>
</table>
