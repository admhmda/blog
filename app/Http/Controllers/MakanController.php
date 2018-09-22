<?php

namespace App\Http\Controllers;

use App\DataTables\MakanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMakanRequest;
use App\Http\Requests\UpdateMakanRequest;
use App\Repositories\MakanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class MakanController extends AppBaseController
{
    /** @var  MakanRepository */
    private $makanRepository;

    public function __construct(MakanRepository $makanRepo)
    {
        $this->middleware('auth');
        $this->makanRepository = $makanRepo;
    }

    /**
     * Display a listing of the Makan.
     *
     * @param MakanDataTable $makanDataTable
     * @return Response
     */
    public function index(MakanDataTable $makanDataTable)
    {
        return $makanDataTable->render('makans.index');
    }

    /**
     * Show the form for creating a new Makan.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('makans.create');
        return view('makans.create');
    }

    /**
     * Store a newly created Makan in storage.
     *
     * @param CreateMakanRequest $request
     *
     * @return Response
     */
    public function store(CreateMakanRequest $request)
    {
        $input = $request->all();

        $makan = $this->makanRepository->create($input);

        Flash::success('Makan saved successfully.');

        return redirect(route('makans.index'));
    }

    /**
     * Display the specified Makan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            Flash::error('Makan not found');

            return redirect(route('makans.index'));
        }

        return view('makans.show')->with('makan', $makan);
    }

    /**
     * Show the form for editing the specified Makan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            Flash::error('Makan not found');

            return redirect(route('makans.index'));
        }

        // edit by dandisy
        //return view('makans.edit')->with('makan', $makan);
        return view('makans.edit')
            ->with('makan', $makan);        
    }

    /**
     * Update the specified Makan in storage.
     *
     * @param  int              $id
     * @param UpdateMakanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMakanRequest $request)
    {
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            Flash::error('Makan not found');

            return redirect(route('makans.index'));
        }

        $makan = $this->makanRepository->update($request->all(), $id);

        Flash::success('Makan updated successfully.');

        return redirect(route('makans.index'));
    }

    /**
     * Remove the specified Makan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $makan = $this->makanRepository->findWithoutFail($id);

        if (empty($makan)) {
            Flash::error('Makan not found');

            return redirect(route('makans.index'));
        }

        $this->makanRepository->delete($id);

        Flash::success('Makan deleted successfully.');

        return redirect(route('makans.index'));
    }
}
