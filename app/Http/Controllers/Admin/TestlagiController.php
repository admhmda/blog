<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TestlagiDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTestlagiRequest;
use App\Http\Requests\Admin\UpdateTestlagiRequest;
use App\Repositories\TestlagiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class TestlagiController extends AppBaseController
{
    /** @var  TestlagiRepository */
    private $testlagiRepository;

    public function __construct(TestlagiRepository $testlagiRepo)
    {
        $this->middleware('auth');
        $this->testlagiRepository = $testlagiRepo;
    }

    /**
     * Display a listing of the Testlagi.
     *
     * @param TestlagiDataTable $testlagiDataTable
     * @return Response
     */
    public function index(TestlagiDataTable $testlagiDataTable)
    {
        return $testlagiDataTable->render('admin.testlagis.index');
    }

    /**
     * Show the form for creating a new Testlagi.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('admin.testlagis.create');
        return view('admin.testlagis.create');
    }

    /**
     * Store a newly created Testlagi in storage.
     *
     * @param CreateTestlagiRequest $request
     *
     * @return Response
     */
    public function store(CreateTestlagiRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $testlagi = $this->testlagiRepository->create($input);

        Flash::success('Testlagi saved successfully.');

        return redirect(route('admin.testlagis.index'));
    }

    /**
     * Display the specified Testlagi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            Flash::error('Testlagi not found');

            return redirect(route('admin.testlagis.index'));
        }

        return view('admin.testlagis.show')->with('testlagi', $testlagi);
    }

    /**
     * Show the form for editing the specified Testlagi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            Flash::error('Testlagi not found');

            return redirect(route('admin.testlagis.index'));
        }

        // edit by dandisy
        //return view('admin.testlagis.edit')->with('testlagi', $testlagi);
        return view('admin.testlagis.edit')
            ->with('testlagi', $testlagi);
    }

    /**
     * Update the specified Testlagi in storage.
     *
     * @param  int              $id
     * @param UpdateTestlagiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestlagiRequest $request)
    {
        $input = $request->all();

        $input['updated_by'] = Auth::user()->id;

        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            Flash::error('Testlagi not found');

            return redirect(route('admin.testlagis.index'));
        }

        $testlagi = $this->testlagiRepository->update($input, $id);

        Flash::success('Testlagi updated successfully.');

        return redirect(route('admin.testlagis.index'));
    }

    /**
     * Remove the specified Testlagi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $testlagi = $this->testlagiRepository->findWithoutFail($id);

        if (empty($testlagi)) {
            Flash::error('Testlagi not found');

            return redirect(route('admin.testlagis.index'));
        }

        $this->testlagiRepository->delete($id);

        Flash::success('Testlagi deleted successfully.');

        return redirect(route('admin.testlagis.index'));
    }
}
