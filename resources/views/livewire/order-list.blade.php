<div class="card">
    <div class="card-header bg-gray">
        @if(session()->has('message'))
            @if(session('alert-type')=='success')
                <i class="fas fa-check-square text-success  p-2 rounded-lg">  {{session('message')}}</i>
            @elseif(session('alert-type')=='error')
                <i class="fas fa-exclamation-triangle text-danger  rounded-lg">  {{session('message')}}</i>
            @endif
        @endif
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
                <span wire:click="sortBy('orders.oid')">ID</span>
            </th>
            <th>
                <span wire:click="sortBy('books.name')">Proizvod</span>
            </th>
            <th>
                <span wire:click="sortBy('books.price')">Cena</span>
            </th>
            <th>
                <span wire:click="sortBy('orders.lastName')">Ime</span>
            </th>
            <th>
                <span wire:click="sortBy('orders.email')">E-mail</span>
            </th>
            <th>
                <span wire:click="sortBy('orders.address')">Adresa</span>
            </th>
            <th>
                <span wire:click="sortBy('orders.status')">Status</span>
            </th>
            <th>
                <span wire:click="sortBy('orders.created_at')">Datum porudzbine</span>
            </th>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->oid}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->price}}$</td>
                    <td>{{$order->fullName}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$order->created_at)->format('d/m/Y')}}</td>
                    @if($order->status==='Pending')
                        <td>
                            <a wire:click="setEnRoute({{$order->oid}})" class="cursor-pointer focus:outline-none">
                                <i
                                    class="fa fa-truck text-teal-500  hover:bg-teal-500 hover:text-white p-2 rounded-lg"></i>
                            </a>
                        </td>
                        <td>
                            <a wire:click="delete({{$order->oid}})" class="cursor-pointer focus:outline-none">
                                <i
                                    class="fa fa-minus text-red-500  hover:bg-teal-500 hover:text-white p-2 rounded-lg"></i>
                            </a>
                        </td>
                    @elseif($order->status==='En Route')
                        <td>
                            <a wire:click="setDelivered({{$order->oid}})" class="cursor-pointer focus:outline-none">
                                <i
                                    class="fa fa-check-square text-teal-500  hover:bg-teal-500 hover:text-white p-2 rounded-lg"></i>
                            </a>
                        </td>
                        <td></td>
                    @else
                        <td></td>
                        <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                {{ $orders->links() }}
            </div>
            <div class="col text-right text-muted">
                {{$orders->count()}} od {{ $orders->total() }} Rezultata
            </div>
        </div>
    </div>
</div>
