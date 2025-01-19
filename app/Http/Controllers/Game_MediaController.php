<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Game_Media;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class Game_MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file', // Adjust validation rules as needed
            'games_id' => 'required|exists:games,id'
        ]);

        try {
            $file = $request->file('file');
            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/media/';
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $videoExtensions = ['mp4', 'mkv', 'avi', 'mov'];
                if (in_array(strtolower($extension), $imageExtensions)) {
                    $jenis = 'image';
                } elseif (in_array(strtolower($extension), $videoExtensions)) {
                    $jenis = 'video';
                } else {
                    return back()->with(['error', 'File format incompatible']);
                }

                $file->move($directory, $fileName);
                if (!$file) {
                    return back()->with('error', 'File has not been selected');
                }
            } else {
                return back()->with('error', 'File is not valid');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'File upload failed: ' . $e->getMessage()]);
        }

        // dd($request->games_id);

        Game_Media::create([
            'nama' => $fileName,
            'jenis' => $jenis,
            'games_id' => $request->games_id,
        ]);

        return back()->with('success', 'File has been uploaded.');
    }

    public function delete($id)
    {        
        $game_media=Game_Media::findOrFail($id);
        $games_id = $game_media->games_id;

        $imagePath = public_path('storage/media/').$game_media->nama;
        if (fileExists($imagePath)) {
            unlink($imagePath);
        }
        
        $game_media->delete();

        return redirect()->route('backend.game.show', $games_id)->with('success', 'File has been deleted.');
    }
}
