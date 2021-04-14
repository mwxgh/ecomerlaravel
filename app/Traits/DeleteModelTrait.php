<?php
namespace App\Traits;

trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model)
    {
        try {
            $model->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ], 500);
        }
    }
}
?>
