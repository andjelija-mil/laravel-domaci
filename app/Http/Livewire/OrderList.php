<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc=true;
    protected $paginationTheme='bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {

        if($this->sortField===$field)
        {
            $this->sortAsc = !$this->sortAsc;
        }
        else
            $this->sortAsc=true;

        $this->sortField=$field;
    }

    public function setEnRoute($id)
    {
        $order=Order::where('id',$id)->first();
        if($order->status==='Pending')
            $order->update(['status'=>'En Route']);
    }

    public function setDelivered($id)
    {
        $order=Order::where('id',$id)->first();
        if($order->status==='En Route')
            $order->update(['status'=>'Delivered']);
    }

    public function delete($id)
    {
        Order::destroy($id);
    }

    public function render()
    {
        return view('livewire.order-list',[
            'orders'=>Order::join('products','orders.product_id','=','products.id')
                ->select('*','orders.id as oid')
                ->where(function ($query){
                    $query->where('orders.id','like','%'.$this->search.'%')
                        ->orWhere('products.name','like','%'.$this->search.'%')
                        ->orWhere('products.price','like','%'.$this->search.'%')
                        ->orWhere('orders.fullName','like','%'.$this->search.'%')
                        ->orWhere('orders.email','like','%'.$this->search.'%')
                        ->orWhere('orders.address','like','%'.$this->search.'%')
                        ->orWhere('orders.status','like','%'.$this->search.'%');
                })->when($this->sortField,function ($query){
                    $query->orderBy($this->sortField,$this->sortAsc ? 'asc' : 'desc');
                })->paginate(5)
        ]);
    }
}
