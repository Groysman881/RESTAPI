<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use App\Http\Resources\NotebookResource;
use App\Services\NotebookService;
use Illuminate\Support\Facades\Validator;

class NotebookController extends Controller
{
    protected NotebookService $notebookService;

    protected array $rules = [
        'name' => 'required',
        'phoneNumber' => 'required|numeric',
        'email' => 'required|email',
        'birthDate' => 'nullable|date',    
    ];

    /**
     * Instantiate a new controller instance.
     *
     * @param  \App\Services\NotebookService  $notebookService
     * @return void
     */
    public function __construct(NotebookService $notebookService)
    {
        $this->notebookService = $notebookService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NotebookResource::collection(Notebook::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $input = $request->except('image');        
        $input['imagePath'] = $this->notebookService->createNewImage($request->image);
        $notebook = Notebook::create($input);
        return new NotebookResource($notebook);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show(Notebook $notebook)
    {
        return new NotebookResource($notebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notebook $notebook)
    {
        $validator = Validator::make($request->all(),$this->rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $newData = $request->except('image');
        $newData['image_path'] = $this->notebookService->deleteOldImage($notebook->image_path);
        $notebook->update($newData);
        return new NotebookResource($notebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();
    }
}
