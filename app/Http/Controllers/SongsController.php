<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Singer;
use App\Models\Song;
use App\Models\SongCategory;
use Illuminate\Http\Request;
use Exception;

class SongsController extends Controller
{

    /**
     * Display a listing of the songs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $songs = Song::with('singer','songcategory')->paginate(25);

        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new song.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $singers = Singer::pluck('name','id')->all();
$songCategories = SongCategory::pluck('name','id')->all();
        
        return view('songs.create', compact('singers','songCategories'));
    }

    /**
     * Store a new song in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Song::create($data);

            return redirect()->route('songs.song.index')
                ->with('success_message', 'Song was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified song.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $song = Song::with('singer','songcategory')->findOrFail($id);

        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified song.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $singers = Singer::pluck('name','id')->all();
$songCategories = SongCategory::pluck('name','id')->all();

        return view('songs.edit', compact('song','singers','songCategories'));
    }

    /**
     * Update the specified song in the storage.
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
            
            $song = Song::findOrFail($id);
            $song->update($data);

            return redirect()->route('songs.song.index')
                ->with('success_message', 'Song was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified song from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $song = Song::findOrFail($id);
            $song->delete();

            return redirect()->route('songs.song.index')
                ->with('success_message', 'Song was successfully deleted.');
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
                'title' => 'string|min:1|max:255|nullable',
            'album' => 'string|min:1|nullable',
            'singer_id' => 'nullable',
            'release_year' => 'string|min:1|nullable',
            'song_category_id' => 'nullable',
            'file' => ['file','nullable'], 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
        }
        if ($request->hasFile('file')) {
            $data['file'] = $this->moveFile($request->file('file'));
        }

        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

}
