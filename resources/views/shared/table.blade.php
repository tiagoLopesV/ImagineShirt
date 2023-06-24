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
        @foreach ($tshirt_images as $tshirt_image)
            <tr>
                    <td width="100">           
                    <img src="{{ $tshirt_image->tshirtPhotoUrl }}" class="center" >
                    </td>
                <td>{{ $tshirt_image->name }}</td>
                <td>{{ $tshirt_image->description }}</td>

                <td> 
                    <form method="POST" action="{{ route('cart.addItem') }}">
                        @csrf
                        <input type="hidden" name="productId" value="{{ $tshirt_image->id }}">
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