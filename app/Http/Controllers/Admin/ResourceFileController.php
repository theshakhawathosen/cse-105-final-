<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceFileController extends Controller
{
    public function destroy($id)
    {
        $file = ResourceFile::findOrFail($id);

        if (Storage::disk('public')->exists($file->file)) {

            Storage::disk('public')->delete($file->file);
        }

        $file->delete();

        return back()->with('success', 'File removed successfully.');
    }
}
