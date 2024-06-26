<?php

namespace App\Http\Controllers;

use App\Services\ArtistService;
use Illuminate\Validation\Validator;
use App\Http\Requests\ExcelImportRequest;
use App\Http\Requests\Artist\ArtistStoreRequest;
use App\Http\Requests\Artist\ArtistUpdateRequest;

class ArtistController extends Controller
{
    protected $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    public function index()
    {
        $data = $this->artistService->readAll();
        return view('artist.index', $data)->with('success', 'Artists.');
    }

    public function create()
    {
        return view('artist.create');
    }

    public function store(ArtistStoreRequest $request)
    {
        $this->artistService->create($request->validated());
        return back()->with('success', 'Artist has been created.');
    }

    public function edit($id)
    {
        $data['artist'] = $this->artistService->read($id);
        if (!$data['artist']) {
            return back()->with('error', 'Artist not found.');
        }
        return view('artist.edit', $data);
    }

    public function update($id, ArtistUpdateRequest $request)
    {
        $data['artist'] = $this->artistService->read($id);
        if (!$data['artist']) {
            return back()->with('error', 'Artist not found.');
        }
        $this->artistService->update($id, $request->validated());
        return redirect()->route('artist.index')->with('success', 'Artist has been updated.');
    }

    public function destroy($identifier)
    {
        $this->artistService->delete($identifier);
        return back()->with('success', 'Artist has been deleted.');
    }

    public function export()
    {
        $this->artistService->export();
    }

    public function import(ExcelImportRequest $request)
    {
        $import = $this->artistService->import($request->file);
        if ($import instanceof Validator) {
            return back()->with('error', 'Please ensure that all required fields are provided in the Excel file.');
        }
        return redirect()->route('artist.index')->with('success', 'Import successful.');
    }
}
