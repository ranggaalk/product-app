<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function dashboard(){
        $title = 'Dashboard';
        $products = Product::orderBy('updated_at', 'DESC')->limit('10')->get();

        return view('admin.dashboard', compact(['title', 'products']));
    }

    public function products(){
        $title = 'Products';
        $products = Product::orderBy('id', 'DESC')->get();

        return view('admin.products', compact(['title', 'products']));
    }

    public function create(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:3|unique:products,name',
            'purchasePrice' => 'required|numeric',
            'sellingPrice' => 'required|numeric',
            'stock' => 'required|numeric',
            'thumbnail' => 'required|mimes:jpg,png|max:100'
        ]);
        try {
            $thumbnail = $request->thumbnail;
            $thumbName = $thumbnail->hashName();

            $createProduct = Product::create([
                'user_id' => 1,
                'name' => $request->name,
                'purchase_price' => $request->purchasePrice,
                'selling_price' => $request->sellingPrice,
                'thumbnail' => $thumbName,
                'stock' => $request->stock
            ]);

            if($createProduct) {
                $thumbnail->storeAs('public/thumbnail/', $thumbName);
                Alert::toast('Success! Product successfully created.', 'success');
                return redirect()->back();
            }
        } catch(Exception $e) {
            Alert::alert('Error!', $e->getMessage(), 'error');
            return redirect()->back();
        }

    }

    public function update(Request $request, $id){
        if($request->hasFile('thumbnail')){
            $validate = $request->validate([
                'name' => 'required|min:3|unique:products,name,'.$id,
                'purchasePrice' => 'required|numeric',
                'sellingPrice' => 'required|numeric',
                'stock' => 'required|numeric',
                'thumbnail' => 'required|mimes:jpg,png|max:100'
            ]);
            try {
                $thumbnail = $request->thumbnail;
                $thumbName = $thumbnail->hashName();

                $product = Product::find($id);
                Storage::delete('public/thumbnail/'. $product->thumbnail);

                $updateProduct = $product->update([
                    'user_id' => 1,
                    'name' => $request->name,
                    'purchase_price' => $request->purchasePrice,
                    'selling_price' => $request->sellingPrice,
                    'thumbnail' => $thumbName,
                    'stock' => $request->stock
                ]);
                if($updateProduct) {
                    $thumbnail->storeAs('public/thumbnail/', $thumbName);
                    Alert::toast('Success! Product successfully updated.', 'success');
                    return redirect()->back();
                }
            } catch(Exception $e) {
                Alert::alert('Terjadi Kesalahan', $e->getMessage(), 'error');
                return redirect()->back();
            }
        } else {
            $validate = $request->validate([
                'name' => 'required|min:3|unique:products,name,'.$id,
                'purchasePrice' => 'required|numeric',
                'sellingPrice' => 'required|numeric',
                'stock' => 'required|numeric',
            ]);
            try {
                $product = Product::find($id);

                $createProduct = $product->update([
                    'user_id' => 1,
                    'name' => $request->name,
                    'purchase_price' => $request->purchasePrice,
                    'selling_price' => $request->sellingPrice,
                    'stock' => $request->stock
                ]);
                Alert::toast('Success! Product successfully updated.', 'success');
                return redirect()->back();
            } catch(Exception $e) {
                Alert::alert('Terjadi Kesalahan', $e->getMessage(), 'error');
                return redirect()->back();
            }
        }
    }

    public function delete(Request $request){
        if(empty($request)){
            return redirect()->back();
        }

        $product = Product::find($request->productId);

        if(!$product){
            return redirect()->back();
        }

        try {
            Storage::delete('public/thumbnail/'. $product->thumbnail);

            $product->delete();
            Alert::toast('Success! Product successfully deleted.', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::alert('Terjadi Kesalahan', $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        Alert::toast('Successfully logout.', 'success');
        return redirect()->route('guest.login');
    }
}
