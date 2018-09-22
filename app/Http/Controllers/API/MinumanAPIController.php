<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMinumanAPIRequest;
use App\Http\Requests\API\UpdateMinumanAPIRequest;
use App\Models\Minuman;
use App\Repositories\MinumanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MinumanController
 * @package App\Http\Controllers\API
 */

class MinumanAPIController extends AppBaseController
{
    /** @var  MinumanRepository */
    private $minumanRepository;

    public function __construct(MinumanRepository $minumanRepo)
    {
        $this->middleware('auth:api');
        $this->minumanRepository = $minumanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/minumen",
     *      summary="Get a listing of the Minumen.",
     *      tags={"Minuman"},
     *      description="Get all Minumen",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Minuman")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->minumanRepository->pushCriteria(new RequestCriteria($request));
        $this->minumanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $minumen = $this->minumanRepository->all();

        return $this->sendResponse($minumen->toArray(), 'Minumen retrieved successfully');
    }

    /**
     * @param CreateMinumanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/minumen",
     *      summary="Store a newly created Minuman in storage",
     *      tags={"Minuman"},
     *      description="Store Minuman",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Minuman that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Minuman")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Minuman"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMinumanAPIRequest $request)
    {
        $input = $request->all();

        $minumen = $this->minumanRepository->create($input);

        return $this->sendResponse($minumen->toArray(), 'Minuman saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/minumen/{id}",
     *      summary="Display the specified Minuman",
     *      tags={"Minuman"},
     *      description="Get Minuman",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Minuman",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Minuman"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Minuman $minuman */
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            return $this->sendError('Minuman not found');
        }

        return $this->sendResponse($minuman->toArray(), 'Minuman retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMinumanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/minumen/{id}",
     *      summary="Update the specified Minuman in storage",
     *      tags={"Minuman"},
     *      description="Update Minuman",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Minuman",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Minuman that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Minuman")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Minuman"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMinumanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Minuman $minuman */
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            return $this->sendError('Minuman not found');
        }

        $minuman = $this->minumanRepository->update($input, $id);

        return $this->sendResponse($minuman->toArray(), 'Minuman updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/minumen/{id}",
     *      summary="Remove the specified Minuman from storage",
     *      tags={"Minuman"},
     *      description="Delete Minuman",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Minuman",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Minuman $minuman */
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            return $this->sendError('Minuman not found');
        }

        $minuman->delete();

        return $this->sendResponse($id, 'Minuman deleted successfully');
    }
}
