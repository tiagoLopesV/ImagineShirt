<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th class="button-icon-col"></th>
            @if (Auth::check() && Auth::user()->user_type !== 'C') 
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
                @if (Auth::check() && Auth::user()->user_type !== 'C') 
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
                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal">
                            <i class="fas fa-trash"></i></button>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@if (!$tshirt_images->isEmpty())
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar a imagem?',
        'msgLine1' => 'Clique no botão "Apagar" para confirmar a operação',
        'msgLine2' => '',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'tshirt_images.destroy',
        'formActionRouteParameters' => ['tshirt_image' => $tshirt_image],
        'formMethod' => 'DELETE',
        'tshirt_image' => $tshirt_image
    ])
@endif