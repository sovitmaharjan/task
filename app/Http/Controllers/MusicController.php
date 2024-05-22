<?php

namespace App\Http\Controllers;

use App\Services\MusicService;
use App\Http\Requests\Music\MusicStoreRequest;
use App\Http\Requests\Music\MusicUpdateRequest;

class MusicController extends Controller
{
    protected $musicService;

    public function __construct(MusicService $musicService)
    {
        $this->musicService = $musicService;
    }

    public function index($artistId)
    {
        $this->musicService->setArtistId($artistId);
        $data = $this->musicService->readAll();
        return view('music.index', $data)->with('success', 'Music.');
    }

    public function create($artistId)
    {
        return view('music.create', compact('artistId'));
    }

    public function store(MusicStoreRequest $request)
    {
        $this->musicService->create($request->validated());
        return back()->with('success', 'Music has been created.');
    }

    public function edit($id)
    {
        $data['music'] = $this->musicService->read($id);
        if (!$data['music']) {
            return back()->with('error', 'Music not found.');
        }
        return view('music.edit', $data);
    }

    public function update($id, MusicUpdateRequest $request)
    {
        $music = $this->musicService->read($id);
        if (!$music) {
            return back()->with('error', 'Music not found.');
        }
        $this->musicService->update($id, $request->validated());
        return redirect()->route('music.index', $music['artist_id'])->with('success', 'Music has been updated.');
    }

    public function destroy($identifier)
    {
        $this->musicService->delete($identifier);
        return back()->with('success', 'Music has been deleted.');
    }
}
