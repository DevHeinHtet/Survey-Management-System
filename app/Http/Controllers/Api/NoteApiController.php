<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Request;
use Veelasky\LaravelHashId\Eloquent\HashableId;

use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Category;

class NoteApiController extends BaseController
{

    // index
    public function index(Request $request){
        $notes = Auth::user()->notes()
            ->when($request->category_id, function($query, $category) {
                $query->where('category_id', Category::hashToId($category));
            })
            ->when($request->key, function($query, $key) {
                $query->where(function($group) use($key){
                    $group->where('title','LIKE', '%'.$key.'%')
                        ->orWhere('description','LIKE', '%'.$key.'%');
                });   
            })
            ->orderBy('id','DESC')->get();
        if($notes){
            return $this->sendResponse('Notes here ...', NoteResource::collection($notes));
        }
        return $this->sendError('Failed ...',"", 404);
    }

    // Store
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        if($request->has('category_id') && $request->category_id != null){
            $category = Auth::user()->category()->byHash($request->category_id)->first();
            if($category){
                $note = Note::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'staff_id' => Auth::user()->id,
                    'category_id' => $category->id,
                ]);
                return $this->sendResponse('new note created successful ...',new NoteResource($note));
            }
            return $this->sendError('Incorrect Folder Name, Please Try Again',"",404); 
        }
        $note = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'staff_id' => Auth::user()->id,
        ]);    
        return $this->sendResponse('new note created successful ...',new NoteResource($note));
    }

    // Show
    public function show(Request $request, $id){
        $note = Auth::user()->notes()->byHash($id)->first();
        if($note){
            return $this->sendResponse('Note Data ...',new NoteResource($note));
        }
        return $this->sendError('Incorrect ...',"",404);
    }
    
    // Update
    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $note = Auth::user()->notes()->byHash($id)->first();
        if($note){
            $note->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return $this->sendResponse('Data updated successful ...',new NoteResource($note));
        }
        return $this->sendError('Incorrect ...',"",404);
    }

    // Delete
    public function delete(Request $request,$id){
        $note = Auth::user()->notes()->byHash($id)->first();
        if($note){
            $note->delete();
            return $this->sendResponse('Data deleted successful ...',"");
        }
        return $this->sendError('Incorrect...',"",404);
    }
}
