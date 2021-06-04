<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use PHPUnit\Util\Exception;

class APIController extends Controller
{
    public function getProducts(Request $request)
    {
        //parameters(all optional): name,minPrice,maxPrice,category
        $fields=$this->getFields($request);
        $products=Product::where(function ($query) use ($fields) {
            if(isset($fields['name']))
                $query->where('name',$fields['name']);
            if(isset($fields['minPrice']))
                $query->where('price','>=',$fields['minPrice']);
            if(isset($fields['maxPrice']))
                $query->where('price','<=',$fields['maxPrice']);
            if(isset($fields['category'])){
                $categoryIds=Category::where('name','like','%'.$fields['category'].'%')->get()->pluck('id')->toArray();
                $query->whereIn('category_id',$categoryIds);
            }
        })->get();
        $responseProducts=[];
        foreach ($products as $product)
        {
            $responseProducts[]=[
                'id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'category'=>$product->category->name,
                'description'=>$product->description ?? ""
            ];
        }

        return response()->json($responseProducts);
    }

    public function makeOrder(Request $request)
    {
        $fields=$this->getFields($request);
        //parameters (required) fullName,address,email,product
        $product=Product::where('name',$fields['product'])->first();
        if(!$product)
            return response()->json(['message'=>'No such product'],404);
        $fields['product_id']=$product->id;
        unset($fields['product']);
        $fields['status']='Pending';
        $response=[];
        $code=201;
        try {
            $order=Order::create($fields);
            $response['message']="Order successfull";
            $response['orderID']=$order->id;
        }catch (Exception $e){
            $response['message']=$e->getMessage();
            $code=500;
        }
        return response()->json($response,$code);
    }

    public function checkOrder($id)
    {
        $order=Order::where('id',$id)->first();
        if(!$order)
            return response()->json(['message'=>'No such order'],404);
        $responseOrder=$order->toArray();
        unset($responseOrder['created_at']);
        unset($responseOrder['updated_at']);
        unset($responseOrder['product_id']);
        $responseOrder['dateOrdered']=$order->created_at->format("d/m/Y");
        $responseOrder['product']=$order->product->name;
        return response()->json($responseOrder);
    }

    public function cancelOrder($id)
    {
        $order=Order::where('id',$id)->first();
        if(!$order)
            return response()->json(['message'=>'No such order'],404);
        if($order->status!=='Pending')
            return response()->json(['message'=>'An order en route,or a delivered one,can not be cancelled'],400);
        $order->delete();
        return response()->json(['message'=>'Order cancelled','orderID'=>$id]);
    }

    public function getOrders(Request $request)
    {
        $fields=$this->getFields($request);
        //paramters(required):fullName , (optional):status
        if(!isset($fields['fullName']))
            return response()->json(['message'=>'Name must be provided'],400);
        $orders=Order::where(function ($query) use ($fields) {
            $query->where('fullName',$fields['fullName']);
            if (isset($fields['status']))
                $query->where('status','like','%'.$fields['status'].'%');
        })->get();
        $responseOrders=[];
        foreach ($orders as $order){
            $responseOrders[]=[
                'id'=>$order->id,
                'fullName'=>$order->fullName,
                'email'=>$order->email,
                'address'=>$order->address,
                'status'=>$order->status,
                'product'=>$order->product->name,
                'orderDate'=>$order->created_at->format("d/m/Y")
            ];
        }
        return response()->json($responseOrders); #vraca u JSON formatu
    }

    public function totalOrderValue(Request $request)
    {
        $fields=$this->getFields($request);
        $value=0;
        //parameters(required):fullName
        if(!isset($fields['fullName']))
            return response()->json(['message'=>'Name must be provided'],400);

        $orders=Order::where(function ($query) use ($fields) {
            $query->where('fullName',$fields['fullName']);
        })->get();
        foreach ($orders as $order)
        {
            $value+=$order->product->price;
        }
        return response()->json(['value'=>$value]);
    }
}
