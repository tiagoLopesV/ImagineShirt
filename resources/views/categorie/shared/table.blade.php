<table class="table">
    <thead class="table-dark">
        <tr>
                <th></th>
            <th>Nome</th>
            <th>Descrição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tshirtImages as $tshirtImage)
            <tr>
                
                    <td width="45">
                        <img src="{{ $tshirtImage->image_url }}" class="bg-dark rounded-circle"
                             width="45" height="45">
                    </td>
                <td>{{ $tshirtImage->name }}</td>
                <td>{{ $tshirtImage->description }}</td>

                <td> 
                    <form method="POST">
                                @csrf
                                <button type="submit" name="addToCart" class="btn btn-success">
                                    <i class="fas fa-plus"></i></button>
                            </form>
                            </td>
            </tr>
        @endforeach
    </tbody>
</table>
