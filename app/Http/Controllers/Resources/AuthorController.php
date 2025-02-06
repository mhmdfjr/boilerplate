<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Author;


class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::orderByDesc('created_at');
        $perPage = 10; 
        $search = $request->input('search');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        $authors = $query->paginate($perPage);

        return view('pages.resources.authors.index', compact('authors'));
    }

    public function create()
    {
        return view("pages.resources.authors.create");
    }

    public function edit(Author $author)
    {
        $data = [
            "author" => $author,
        ];

        return view("pages.resources.authors.edit", $data);
    }

    public function update(Request $request, Author $author)
    {
        $credentials = $request->validate([
            "name"   => "required|unique:authors,name," . $author->id,
            "position" => "required"
        ]);

        $updated = $author->update($credentials);
        
        $message = [
            "status" => $updated ? "success" : "failed",
            "message" => $updated ? "Data updated successfully" : "Data failed to update!"
        ];

        if ($request->has('update')) {
            return Redirect::back()->with("message", $message);
        } else {
            return Redirect::route("authors.index")->with("message", $message);
        }
    }

    public function destroy(Author $author)
    {
        if(!$author) {
            $message = [
                "status" => "failed",
                "message" => "Permission Not Found"
            ];
            return Redirect::route("authors.index")->with("message", $message);
        }

        $author = $author->delete();

        $message = [
            "status" => $author ? "success" : "failed",
            "message" => $author ? "Data deleted successfully" : "Data failed to delete!"
        ];

        return Redirect::route("authors.index")->with("message", $message);
    }

}
