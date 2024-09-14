<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Rules\CheckCategoryDataDuplicate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Note;
use Validator;

class CategoryApiController extends BaseController
{

    // get categories
    public function index(){

        $categories = Category::where('staff_id', auth()->user()->id)
                                ->get();
        return $this->sendResponse('Categories here ...', CategoryResource::collection($categories));
    }

    // create for category
    public function store(Request $request){
        $request->validate([
            'name' => ['required', new CheckCategoryDataDuplicate()],
        ]);
        

        $category = Category::create([
            'name' => $request->name,
            'staff_id' => auth::user()->id,
        ]);

        if($category){
            return $this->sendResponse($category->name.' Folder is created ...', ['category'=>new CategoryResource($category)]);
        }
        return $this->sendError('Failed to create, please retry...',"");
    }

    public function delete($id){
        $category =  Auth::user()->category()->byHash($id)->first();
        if($category){
            Auth::user()->notes()->where('category_id',$category->id)->delete();
            $category->delete();
            return $this->sendResponse('Deleted Successfully ...', 1);
        }
        return $this->sendError('Failed to delete, please retry ...',"",404);
    }
}
