<div class="card">
    <div class="card-header bg-gray">
        <div class="d-flex flex-column flex-sm-row d-flex justify-content-end">
            <livewire:user-register />
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
                <span wire:click="sortBy('id')">ID</span>
            </th>
            <th>
                <span wire:click="sortBy('name')">Ime</span>
            </th>
            <th>
                <span wire:click="sortBy('email')">E-mail</span>
            </th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr @if($user->id===auth()->user()->id) class="text-danger" @endif>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                {{ $users->links() }}
            </div>
            <div class="col text-right text-muted">
                {{$users->count()}} od {{ $users->total() }} Rezultata
            </div>
        </div>
    </div>
</div>
