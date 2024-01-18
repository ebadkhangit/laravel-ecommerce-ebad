<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Http\Controllers\TempImagesController;
use App\Models\TempImage;

 
class CategoryController extends Controller
{
    public function index()
    {
         $categories = Category::latest()->paginate(10);

         //$data['categories'] = $categories;
          return view('admin.category.list',compact('categories'));
          
    }

    public function create()
    {
    	return view('admin.category.create');


    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories',
             ]);

        

        if($validator->passes()){

            
        $category = new Category();

        $category->name = $request->name;
          $category->slug = $request->slug;
            $category->status = $request->status;
          
             $category->save();

             // save image here

             if(!empty($request->image_id)){

                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sPath,$dPath);
                $category->image = $newImageName;
                $category->save(); 


             }
              
              $request->session()->flash('success','Category added successfully');

             return response()->json([
                'status'=> true,
                'message' => 'Category Added Successfully'
                ]);

        } else{

            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()

            ]);
        }

}

public function edit($categoryId, Request $request){


    $category = Category::find($categoryId);

    if(empty($category)) {

        return redirect()->route('categories.index');
    }

    return view('admin.category.edit',compact('category'));



}

public function update($categoryId, Request $request){

      $category = Category::find($categoryId);

        if(empty($category)) {
            return response()->json([

                'status' => false,
                'notFound' => true,
                'message' =>' Category Not Found'


            ]);

    }

    $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
             ]);

        

        if($validator->passes()){

            
       // $category = new Category();

        $category->name = $request->name;
          $category->slug = $request->slug;
            $category->status = $request->status;
          
             $category->save();

             $oldImage = $category->image;

             // save image here

             if(!empty($request->image_id)){

                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sPath,$dPath);
                $category->image = $newImageName;
                $category->save(); 

                // delete old image 

                File:: delete(public_path().'/uploads/category/'.$oldImage);


             }
              
              $request->session()->flash('success','Category Updated successfully');

             return response()->json([
                'status'=> true,
                'message' => 'Category Updated Successfully'
                ]);

        } else{

            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()

            ]);
        }
}
        public function destroy($categoryId, Request $request){

             $category = Category::find($categoryId);

    if(empty($category)) {

            $request->session()->flash('error','Category not Fount');


         return response()->json([
        'satus' => true,
        'message' => 'Category not Fount'


    ]);

    }

    File:: delete(public_path().'/uploads/category/'.$category->image);

    $category ->delete();
    $request->session()->flash('success','Category Deleted Successfully');

    return response()->json([
        'satus' => true,
        'message' => 'Category Deleted Successfully'


    ]);

   



        }



  }   
  







