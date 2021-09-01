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
        if($oldPhoto){
            $photoPath = public_path("images/$table/" . $oldPhoto);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

    }

     // return data
     public function returnData($key,$value,$message="",$status=200)
     {
         return response()->json(
             [
                 'success'=>true,
                 'message'=>$message,
                 'details'=>(object)[$key=>$value]
             ],$status
         );
     }

     public function returnUserWithToken(object $value,$token,$message="",$status=200)
     {
        $value->token = $token;
        $value->expire_in = auth('api')->factory()->getTTL() * 60;
        return $this->returnData('user',$value,$message,$status);
     }

     // return success message
     public function returnSuccessMessage($message="",$status=200)
     {
         return response()->json(
             [
                 'success'=>true,
                 'message'=>$message,
                 'details'=>(object)[]
             ],$status
         );
     }
         // return error message

     public function returnErrorMessage($validationError = null,$message="",$status=400)
     {
         return response()->json(
             [
                 'success'=>false,
                 'message'=>$message,
                 'details'=>$validationError === null ? (object)[] : $validationError
             ],$status
         );
     }
     // return error validation
     public function returnValidationError($validator,$msg = 'Validation Error',$status = 403)
     {
         $jsonError = (object)[];
         foreach ($validator->errors()->toArray() as $k => $vs) {
             foreach($vs as $val)
             {
                 $jsonError->{$k} = $val;
             }
         }
         return $this->returnErrorMessage($jsonError,$msg,$status);
     }
}
