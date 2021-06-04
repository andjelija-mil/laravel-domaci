<div class="card">
    <div class="card-header bg-gray">

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
                <span wire:click="sortBy('id')">ID</span>
            </th>
            <th>
                <span wire:click="sortBy('name')">Naziv</span>
            </th>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{route('categoriesEdit',$category->id)}}" class="cursor-pointer btn btn-warning">
                            Izmeni
                        </a>
                    </td>
                    <td>
                        <form action="{{route('categoriesDestroy',$category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="cursor-pointer btn btn-danger">Ukloni</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                {{ $categories->links() }}
            </div>
            <div class="col text-right text-muted">
                {{$categories->count()}} od {{ $categories->total() }} Rezultata
            </div>
        </div>

    </div>
</div>
