<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tshirtImages as $tshirtImage)
            <tr>
                    <td width="100">           
                    <img src="{{ $tshirtImage->tshirtPhotoUrl }}" class="center" >
                    </td>
                <td>{{ $tshirtImage->name }}</td>
                <td>{{ $tshirtImage->description }}</td>

                <td> 
                    <form method="POST" action="{{ route('cart.addItem') }}">
                        @csrf
                        <input type="hidden" name="productId" value="{{ $tshirtImage->id }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                        <td class="button-icon-col"><a class="btn btn-dark"
                        href="">
                            <i class="fas fa-edit"></i></a></td>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>