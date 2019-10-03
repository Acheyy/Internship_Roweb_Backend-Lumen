<?php

namespace App\Http\Controllers;

use App\Services\PromotionService;
use App\Helpers\ErrorCodes;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 */
class PromotionController extends Controller
{

    /** @var PromotionService */
    protected $promotionService;

    /**
     * PromotionController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->promotionService = new PromotionService();
    }

    /**
     * Create a promotion
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
             /** @var \Illuminate\Validation\Validator $validator */
             $validator = $this->promotionService->validateCreateRequest($request);

             if (!$validator->passes()) {
                 return $this->returnError($validator->messages(), ErrorCodes::REQUEST_ERROR);
             }

            $promotion = new Promotion($request->all());

            $promotion->user_id = Auth::user()->id;

            $promotion->save();

            return $this->returnSuccess("The promotion has been added successfully", $promotion);
        } catch (\Exception $e) {
            dd($e);

            return $this->returnError($e->getMessage(), ErrorCodes::FRAMEWORK_ERROR);
        }
    }

    /**
     * Get all promotions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $pagParams = $this->getPaginationParams($request);

            $promotions = Promotion::where('id', '!=', null);

            $paginationData = $this->getPaginationData($promotions, $pagParams['page'], $pagParams['limit']);

            $promotions = $promotions->offset($pagParams['offset'])->limit($pagParams['limit'])->get();

            return $this->returnSuccess($promotions, $paginationData);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), ErrorCodes::FRAMEWORK_ERROR);
        }
    }   
}
