<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryService
 *
 * @package App\Services
 */
class PromotionService
{
    public function validateCreateRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
            'percent' => 'required',
            
        ];

        $messages = [
            'name.required' => 'errors.name.required',
            'percent.required' => 'errors.percent.required',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function validateUpdateRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
            'percent' => 'required',
        ];

        $messages = [
            'name.required' => 'errors.name.required',
            'percent.required' => 'errors.percent.required',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
