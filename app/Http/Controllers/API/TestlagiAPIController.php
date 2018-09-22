<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestlagiAPIRequest;
use App\Http\Requests\API\UpdateTestlagiAPIRequest;
use App\Models\Testlagi;
use App\Repositories\TestlagiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TestlagiController
 * @package App\Http\Controllers\API
 */

class TestlagiAPIController extends AppBaseController
{
    /** @var  TestlagiRepository */
    private $testlagiRepository;

    public function __construct(TestlagiRepository $testlagiRepo)
    {
        $this->middleware('auth:api');
        $this->testlagiRepository = $testlagiRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/testlagis",
     *      summary="Get a listing of the Testlagis.",
     *      tags={"Testlagi"},
     *      description="Get all Testlagis",
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
     *                  @SWG\Items(ref="#/definitions/Testlagi")
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
        $this->testlagiRepository->pushCriteria(new RequestCriteria($request));
        $this->testlagiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $testlagis = $this->testlagiRepository->all();

        return $this->sendResponse($testlagis->toArray(), 'Testlagis retrieved successfully');
    }

    /**
     * @param CreateTestlagiAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/testlagis",
     *      summary="Store a newly created Testlagi in storage",
     *      tags={"Testlagi"},
     *      description="Store Testlagi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testlagi that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testlagi")
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
     *                  ref="#/definitions/Testlagi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestlagiAPIRequest $request)
    {
        $input = $request->all();

        $testlagis = $this->testlagiRepository->create($input);

        return $this->sendResponse($testlagis->toArray(), 'Testlagi saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/testlagis/{id}",
     *      summary="Display the specified Testlagi",
     *      tags={"Testlagi"},
     *      description="Get Testlagi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testlagi",
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
     *                  ref="#/definitions/Testlagi"
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
        /** @var Testlagi $testlagi */
        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            return $this->sendError('Testlagi not found');
        }

        return $this->sendResponse($testlagi->toArray(), 'Testlagi retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTestlagiAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/testlagis/{id}",
     *      summary="Update the specified Testlagi in storage",
     *      tags={"Testlagi"},
     *      description="Update Testlagi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testlagi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testlagi that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testlagi")
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
     *                  ref="#/definitions/Testlagi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestlagiAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testlagi $testlagi */
        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            return $this->sendError('Testlagi not found');
        }

        $testlagi = $this->testlagiRepository->update($input, $id);

        return $this->sendResponse($testlagi->toArray(), 'Testlagi updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/testlagis/{id}",
     *      summary="Remove the specified Testlagi from storage",
     *      tags={"Testlagi"},
     *      description="Delete Testlagi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testlagi",
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
        /** @var Testlagi $testlagi */
        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            return $this->sendError('Testlagi not found');
        }

        $testlagi->delete();

        return $this->sendResponse($id, 'Testlagi deleted successfully');
    }
}
