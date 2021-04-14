<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Http\Requests\ProductAddRequest;
use App\Components\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminProductController extends Controller
{
    use StorageImageTrait,DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category= $category;
        $this->product= $product;
        $this->productImage= $productImage;
        $this->tag = $tag;
        $this->productTag =$productTag;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate(10);
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $optionCategory=$this->getCategory($parentId = '');
        return view('admin.product.create',compact('optionCategory'));
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $optionCategory = $recusive->categoryRecusive($parentId);
        return $optionCategory;
    }
    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate =[
                'name' =>$request->name,
                'price'=>$request->price,
                'content'=>$request->contents,
                'user_id'=>auth()->id(),
                'category_id'=>$request->category_id
            ];
            //using storageTraitUpload from Traits
            $dataUploadFeature = $this->storageTraitUpload($request,'feature_image_path','product_img');
            if (!empty($dataUploadFeature)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeature['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeature['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            //Insert data to product_image
            if ($request->hasFile('image_path')) {
                foreach ($request ->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMulti($fileItem,'product_img');
                    // using images eloquent relationship from models
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert product_tag
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    //insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[]= $tagInstance->id;
                }
            }

            // use tags eloquent relationship from models
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');

        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Message :' . $error->getMessage() . ' --- line :' .$error->getLine());
        }
    }
    public function edit($id)
    {
        $product = $this->product->find($id);
        $optionCategory=$this->getCategory($product->category_id);
        return view('admin.product.edit',compact('optionCategory','product'));
    }
    public function update(Request $request , $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate =[
                'name' =>$request->name,
                'price'=>$request->price,
                'content'=>$request->contents,
                'user_id'=>auth()->id(),
                'category_id'=>$request->category_id
            ];
            $dataUploadFeature = $this->storageTraitUpload($request,'feature_image_path','product_img');
            if (!empty($dataUploadFeature)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeature['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeature['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);

            // above query return boolean
            // below query return string product by id
            $product = $this->product->find($id);
            //Insert data to product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id',$id)->delete();
                foreach ($request ->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMulti($fileItem,'product_img');
                    // using image eloquent relationship from models
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert product_tag
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    //insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[]= $tagInstance->id;
                }
            }
            // use tags eloquent relationship from models
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');

        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Message :' . $error->getMessage() . ' --- line :' .$error->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->product);

        //without include Traits
        // try {
        //     $this->product->find($id)->delete();
        //     return response()->json([
        //         'code'=>200,
        //         'message'=>'success'
        //     ], 200);
        // } catch (\Exception $e) {
        //     Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        //     return response()->json([
        //         'code'=>500,
        //         'message'=>'fail'
        //     ], 500);
        // }

    }
}
