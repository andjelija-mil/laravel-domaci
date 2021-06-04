<div class="card">
    <div class="card-header bg-gray">
        @if(session()->has('message'))
            @if(session('alert-type')=='success')
                <i class="fas fa-check-square text-success  p-2 rounded-lg">  {{session('message')}}</i>
            @elseif(session('alert-type')=='error')
                <i class="fas fa-exclamation-triangle text-danger  rounded-lg">  {{session('message')}}</i>
            @endif
        @endif
        <div class="d-flex flex-column flex-sm-row d-flex justify-content-end">
            <a href="{{route('productsCreate')}}" class="btn btn-info">Dodaj proizvod</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col">
                <input wire:model="search" id="search" class="form-control" type="text" placeholder="Pretraga">
            </div>
        </div>
        <table class="table table-striped divide-y divide-gray-200 ">
            <thead>
            <th>
                <span wire:click="sortBy('products.pid')">ID</span>
            </th>
            <th>
                <span wire:click="sortBy('categories.cname')">Kategorija</span>
            </th>
            <th>
                <span wire:click="sortBy('products.pname')">Naziv</span>
            </th>
            <th>
                <span wire:click="sortBy('products.price')">Cena</span>
            </th>
            <th>
                <span wire:click="sortBy('products.description')">Opis</span>
            </th>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->pid}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->pname}}</td>
                    <td>{{$product->price}}$</td>
                    <td>{{$product->description ?? ""}}</td>
                    <td>
                        <a href="{{route('productsEdit',$product->pid)}}" class="btn btn-warning">Izmeni</a>
                    </td>
                    <td>
                        <form action="{{route('productsDestroy',$product->pid)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Izbrisi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                {{ $products->links() }}
            </div>
            <div class="col text-right text-muted">
                {{$products->count()}} od {{ $products->total() }} Rezultata
            </div>
        </div>
    </div>
</div>
