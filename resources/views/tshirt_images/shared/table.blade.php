<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th class="button-icon-col"></th>
            @if (Auth::user()->user_type !== 'C') 
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
            @endif
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
                @if (Auth::user()->user_type === 'C') 
                <td> 
                    <form method="POST" action="{{ route('cart.addItem') }}">
                        @csrf
                        <input type="hidden" name="productId" value="{{ $tshirt_image->id }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </td>
                @else
                <td class="button-icon-col"><a href="{{ route('tshirt_images.show', ['tshirt_image' => $tshirt_image]) }}"
                            class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                <td class="button-icon-col"><a href="{{ route('tshirt_images.edit', ['tshirt_image' => $tshirt_image]) }}"
                            class="btn btn-dark"><i class="fas fa-edit"></i></a></td>
                <td class="button-icon-col">
                    <form method="POST" action="{{ route('tshirt_images.destroy', ['tshirt_image' => $tshirt_image]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>