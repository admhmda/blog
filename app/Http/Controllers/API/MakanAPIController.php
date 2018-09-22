<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMakanAPIRequest;
use App\Http\Requests\API\UpdateMakanAPIRequest;
use App\Models\Makan;
use App\Repositories\MakanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MakanController
 * @package App\Http\Controllers\API
 */

class MakanAPIController extends AppBaseController
{
    /** @var  MakanRepository */
    private $makanRepository;

    public function __construct(MakanRepository $makanRepo)
    {
        $this->middleware('auth:api');
        $this->makanRepository = $makanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/makans",
     *      summary="Get a listing of the Makans.",
     *      tags={"Makan"},
     *      description="Get all Makans",
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
     *                  @SWG\Items(ref="#/definitions/Makan")
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
        $this->makanRepository->pushCriteria(new RequestCriteria($request));
        $this->makanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $makans = $this->makanRepository->all();

        return $this->sendResponse($makans->toArray(), 'Makans retrieved successfully');
    }

    /**
     * @param CreateMakanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/makans",
     *      summary="Store a newly created Makan in storage",
     *      tags={"Makan"},
     *      description="Store Makan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Makan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Makan")
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
     *                  ref="#/definitions/Makan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMakanAPIRequest $request)
    {
        $input = $request->all();

        $makans = $this->makanRepository->create($input);

        return $this->sendResponse($makans->toArray(), 'Makan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/makans/{id}",
     *      summary="Display the specified Makan",
     *      tags={"Makan"},
     *      description="Get Makan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Makan",
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
     *                  ref="#/definitions/Makan"
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
        /** @var Makan $makan */
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            return $this->sendError('Makan not found');
        }

        return $this->sendResponse($makan->toArray(), 'Makan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMakanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/makans/{id}",
     *      summary="Update the specified Makan in storage",
     *      tags={"Makan"},
     *      description="Update Makan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Makan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Makan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Makan")
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
     *                  ref="#/definitions/Makan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMakanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Makan $makan */
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            return $this->sendError('Makan not found');
        }

        $makan = $this->makanRepository->update($input, $id);

        return $this->sendResponse($makan->toArray(), 'Makan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/makans/{id}",
     *      summary="Remove the specified Makan from storage",
     *      tags={"Makan"},
     *      description="Delete Makan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Makan",
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
        /** @var Makan $makan */
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            return $this->sendError('Makan not found');
        }

        $makan->delete();

        return $this->sendResponse($id, 'Makan deleted successfully');
    }
}
