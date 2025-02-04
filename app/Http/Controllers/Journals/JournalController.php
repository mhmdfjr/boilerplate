<?php

namespace App\Http\Controllers\Journals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Journal;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Journal::orderByDesc('created_at');
        $perPage = 10; 
        $search = $request->input('search');

        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }
    
        $journals = $query->paginate($perPage);

        return view('pages.resources.journals.index', compact('journals'));
    }

    public function create()
    {
        return view("pages.resources.journals.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                "title"      => "required|unique:journals,title",
                "content"    => "required"
            ]
        );
        $credentials['user_id'] = Auth::id();

        $journal = Journal::create($credentials);

        $message = [
            "status" => $journal ? "success" : "failed",
            "message" => $journal ? "Data created successfully" : "Data failed to create!"
        ];

        if ($request->has('save')) {
            return redirect()->route('journals.create')->with("message", $message);
        } else {
            return redirect()->route('journals.index')->with("message", $message);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Journal $journal)
    {
        $data = [
            "journal" => $journal,
        ];

        return view("pages.resources.journals.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journal $journal)
    {
        $credentials = $request->validate([
            "title"   => "required|unique:journals,title," . $journal->id,
            "content" => "required"
        ]);

        $credentials['user_id'] = Auth::id();

        $updated = $journal->update($credentials);
        
        $message = [
            "status" => $updated ? "success" : "failed",
            "message" => $updated ? "Data updated successfully" : "Data failed to update!"
        ];

        if ($request->has('update')) {
            return Redirect::back()->with("message", $message);
        } else {
            return Redirect::route("journals.index")->with("message", $message);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal)
    {
        if(!$journal) {
            $message = [
                "status" => "failed",
                "message" => "Permission Not Found"
            ];
            return Redirect::route("journals.index")->with("message", $message);
        }

        $journal = $journal->delete();

        $message = [
            "status" => $journal ? "success" : "failed",
            "message" => $journal ? "Data deleted successfully" : "Data failed to delete!"
        ];

        return Redirect::route("journals.index")->with("message", $message);
    }
}
