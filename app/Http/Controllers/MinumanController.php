<?php

namespace App\Http\Controllers;

use App\DataTables\MinumanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMinumanRequest;
use App\Http\Requests\UpdateMinumanRequest;
use App\Repositories\MinumanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class MinumanController extends AppBaseController
{
    /** @var  MinumanRepository */
    private $minumanRepository;

    public function __construct(MinumanRepository $minumanRepo)
    {
        $this->middleware('auth');
        $this->minumanRepository = $minumanRepo;
    }

    /**
     * Display a listing of the Minuman.
     *
     * @param MinumanDataTable $minumanDataTable
     * @return Response
     */
    public function index(MinumanDataTable $minumanDataTable)
    {
        return $minumanDataTable->render('minumen.index');
    }

    /**
     * Show the form for creating a new Minuman.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('minumen.create');
        return view('minumen.create');
    }

    /**
     * Store a newly created Minuman in storage.
     *
     * @param CreateMinumanRequest $request
     *
     * @return Response
     */
    public function store(CreateMinumanRequest $request)
    {
        $input = $request->all();

        $minuman = $this->minumanRepository->create($input);

        Flash::success('Minuman saved successfully.');

        return redirect(route('minumen.index'));
    }

    /**
     * Display the specified Minuman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            Flash::error('Minuman not found');

            return redirect(route('minumen.index'));
        }

        return view('minumen.show')->with('minuman', $minuman);
    }

    /**
     * Show the form for editing the specified Minuman.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            Flash::error('Minuman not found');

            return redirect(route('minumen.index'));
        }

        // edit by dandisy
        //return view('minumen.edit')->with('minuman', $minuman);
        return view('minumen.edit')
            ->with('minuman', $minuman);        
    }

    /**
     * Update the specified Minuman in storage.
     *
     * @param  int              $id
     * @param UpdateMinumanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMinumanRequest $request)
    {
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            Flash::error('Minuman not found');

            return redirect(route('minumen.index'));
        }

        $minuman = $this->minumanRepository->update($request->all(), $id);

        Flash::success('Minuman updated successfully.');

        return redirect(route('minumen.index'));
    }

    /**
     * Remove the specified Minuman from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $minuman = $this->minumanRepository->findWithoutFail($id);

        if (empty($minuman)) {
            Flash::error('Minuman not found');

            return redirect(route('minumen.index'));
        }

        $this->minumanRepository->delete($id);

        Flash::success('Minuman deleted successfully.');

        return redirect(route('minumen.index'));
    }
}
