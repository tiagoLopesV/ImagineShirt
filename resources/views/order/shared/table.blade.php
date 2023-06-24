<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Status</th>
            <th>Cliente(ID)</th>
            <th>Nif</th>
            <th>Preço</th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->status }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->nif }}</td>
                <td>{{ $order->total_price }}</td>
                <td class="button-icon-col"><a href="{{ route('order.show', ['order' => $order]) }}"
                            class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                <td class="button-icon-col"><a href="{{ route('order.edit', ['order' => $order]) }}"
                            class="btn btn-dark"><i class="fas fa-edit"></i></a></td>
                <td class="button-icon-col">
                    <form method="POST" action="{{ route('order.destroy', ['order' => $order]) }}">
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
