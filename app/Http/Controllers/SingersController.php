<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Singer;
use Illuminate\Http\Request;
use Exception;

class SingersController extends Controller
{

    /**
     * Display a listing of the singers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $singers = Singer::paginate(25);

        return view('singers.index', compact('singers'));
    }

    /**
     * Show the form for creating a new singer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('singers.create');
    }

    /**
     * Store a new singer in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Singer::create($data);

            return redirect()->route('singers.singer.index')
                ->with('success_message', 'Singer was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified singer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $singer = Singer::findOrFail($id);

        return view('singers.show', compact('singer'));
    }

    /**
     * Show the form for editing the specified singer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $singer = Singer::findOrFail($id);
        

        return view('singers.edit', compact('singer'));
    }

    /**
     * Update the specified singer in the storage.
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
            
            $singer = Singer::findOrFail($id);
            $singer->update($data);

            return redirect()->route('singers.singer.index')
                ->with('success_message', 'Singer was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified singer from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $singer = Singer::findOrFail($id);
            $singer->delete();

            return redirect()->route('singers.singer.index')
                ->with('success_message', 'Singer was successfully deleted.');
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
            'gender' => 'nullable',
            'music_type' => 'array|nullable',
            'is_retired' => 'boolean|nullable', 
        ];
        
        $data = $request->validate($rules);

        $data['is_retired'] = $request->has('is_retired');

        return $data;
    }

}
