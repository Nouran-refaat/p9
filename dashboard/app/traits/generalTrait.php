<?php

namespace App\traits;
use Illuminate\Support\Facades\DB;
trait generalTrait {
    public function uploadPhoto($image,$folder)
    {
        $photoName = time() . '.' . $image->extension();
        $image->move(public_path('images/'.$folder), $photoName);
        return $photoName;
    }

    public function deletePhoto($table,$id)
    {
        $oldPhoto = DB::table($table)->select('image')->where('id', $id)->first()->image;
        $photoPath = public_path("images/$table/" . $oldPhoto);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }
}
