<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SongCategory;
use Illuminate\Http\Request;
use Exception;

class SongCategoriesController extends Controller
{

    /**
     * Display a listing of the song categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $songCategories = SongCategory::paginate(25);

        return view('song_categories.index', compact('songCategories'));
    }

    /**
     * Show the form for creating a new song category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('song_categories.create');
    }

    /**
     * Store a new song category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SongCategory::create($data);

            return redirect()->route('song_categories.song_category.index')
                ->with('success_message', 'Song Category was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified song category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $songCategory = SongCategory::findOrFail($id);

        return view('song_categories.show', compact('songCategory'));
    }

    /**
     * Show the form for editing the specified song category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $songCategory = SongCategory::findOrFail($id);
        

        return view('song_categories.edit', compact('songCategory'));
    }

    /**
     * Update the specified song category in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $songCategory = SongCategory::findOrFail($id);
            $songCategory->update($data);

            return redirect()->route('song_categories.song_category.index')
                ->with('success_message', 'Song Category was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified song category from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $songCategory = SongCategory::findOrFail($id);
            $songCategory->delete();

            return redirect()->route('song_categories.song_category.index')
                ->with('success_message', 'Song Category was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'string|min:1|max:255|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
