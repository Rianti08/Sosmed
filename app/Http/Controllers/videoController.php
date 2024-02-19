<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(2); 
        return view('video.index', compact('videos'));
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10240'],
            'caption' => ['nullable', 'string', 'max:100'], 
        ]);

        $video = new Video();
        $video->created_by = auth()->id(); 
        $video->video = $request->file('video')->store('video'); 
        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('video.index')->with('success', 'video berhasil disimpan!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->video) {
            Storage::delete($video->video);
        }

        if ($video->delete()) {
            return redirect()->route('video.index')->with('success', 'video berhasil dihapus!');
        }

        return redirect()->route('video.index')->with('error', 'Gagal menghapus feed.');
    }
}