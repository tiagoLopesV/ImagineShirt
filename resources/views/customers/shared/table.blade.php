<table class="table">
    <thead class="table-dark">
        <tr>
                <th></th>
            <th>Nome</th>
            <th>Descrição</th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                    <td width="45">
                    <img src="{{ $customer->user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                    </td>
                <td>{{ $customer->user->name }}</td>
                <td>{{ $customer->nif }}</td>
                <td class="button-icon-col"><a href="{{ route('customers.show', ['customer' => $customer]) }}"
                            class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                <td class="button-icon-col"><a href="{{ route('customers.edit', ['customer' => $customer]) }}"
                            class="btn btn-dark"><i class="fas fa-edit"></i></a></td>
                <td class="button-icon-col">
                    <form method="POST" action="{{ route('customers.destroy', ['customer' => $customer]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
