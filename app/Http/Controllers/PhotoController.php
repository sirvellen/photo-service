<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
    {
        return 'Get method';
    }

    public function show(Photo $photo)
    {
        return $photo;
    }

    public function store(PhotoRequest $request)
    {

        if ($photo = Photo::create([
            'photo_url' => $this->uploadFile($request->file('photo')),
            'owner_id' => Auth::user()->id,
        ])) {

            return response()->json([
                'id' => $photo->id,
                'name' => $photo->name,
                'url' => 'http://localhost:8080/photo-service/' . $photo->photo_url,
            ])->setStatusCode(201, 'Created');
        }
        return response()->json([
            'message' => 'file upload error',
        ])->setStatusCode(422, 'Unprocessable entity');
    }

    public function update(Photo $photo, PhotoRequest $request)
    {
        $update = [];

        if ($request->file('photo')) {
            $update['photo_url'] = $this->uploadFile($request->file('photo'));
        }

        $photo->update(array_merge($request->all(), $update));

        return response()->json($photo)->setStatusCode(201, 'Succesful Update');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->delete()) {
            return response()->json([
                'message' => 'Success delete'
            ])->setStatusCode(204, 'Deleted');
        }
        return response()->json([
            'message' => 'Error'
        ])->setStatusCode(403, 'Forbidden');
    }

    public function uploadFile($file)
    {
        $fileName = uniqid() . '.' . $file->extension();
        $fullDir = 'public/images';

        return $file->storeAs($fullDir, $fileName);
    }
}
