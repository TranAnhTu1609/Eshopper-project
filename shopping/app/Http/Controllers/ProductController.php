<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\ProductImage;
use App\Product;
use App\ProductTag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $tags;
    private $productImage;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tags, ProductTag $productTag) {
        $this->category=$category;
        $this->product = $product;
        $this->productImage=$productImage;
        $this->tags=$tags;
        $this->productTag=$productTag;
    }
    public function index() {
        $products =$this->product->latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }
    public  function  getCategory($parent_id)
    {
        $data=$this->category->all();
        $recusive = new Recusive($data);
        $htmlOption=$recusive->categoryRecusive($parent_id);
        return $htmlOption;
    }
    public function create() {
        $htmlOption=$this->getCategory($parent_id='');
        return view('admin.product.add',compact('htmlOption'));
    }
    public function store(ProductAddRequest $request) {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'views_count'=>0
            ];
            $data = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($data)) {
                $dataProductCreate['feature_image_name'] = $data['file_name'];
                $dataProductCreate['feature_image_path'] = $data['file_path'];
            }

            $product=$this->product->create($dataProductCreate);

            //insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //insert tags for product
            $tagIds=[];
            if(!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }

            }
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());

        }
    }
    public function edit($id) {
        $product=$this->product->find($id);
        $htmlOption=$this->getCategory($product->category_id);
        return view('admin.product.edit',compact('htmlOption','product'));
    }
    public function update($id,Request $request) {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'views_count'=>0
            ];

            $data = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($data)) {
                $dataProductUpdate['feature_image_name'] = $data['file_name'];
                $dataProductUpdate['feature_image_path'] = $data['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product=$this->product->find($id);

            //insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //insert tags for product
            $tagIds=[];
            if(!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }

            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());

        }
    }
    public function delete($id) {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ],200);
        }
        catch (\Exception $exception) {
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail',
            ],500);
        }
    }
}
