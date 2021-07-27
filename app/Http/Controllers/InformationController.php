<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InformationCreateRequest;
use App\Http\Requests\InformationUpdateRequest;
use App\Repositories\Interfaces\InformationRepository;
use App\Repositories\Validators\InformationValidator;

/**
 * Class InformationController.
 *
 * @package namespace App\Http\Controllers;
 */
class InformationController extends Controller
{
    /**
     * @var InformationRepository
     */
    protected $repository;

    /**
     * @var InformationValidator
     */
    protected $validator;

    /**
     * InformationController constructor.
     *
     * @param InformationRepository $repository
     * @param InformationValidator $validator
     */
    public function __construct(InformationRepository $repository, InformationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $information = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $information,
            ]);
        }

        return view('information.index', compact('information'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InformationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InformationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $information = $this->repository->create($request->all());

            $response = [
                'message' => 'Information created.',
                'data'    => $information->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $information = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $information,
            ]);
        }

        return view('information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $information = $this->repository->find($id);

        return view('information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InformationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InformationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $information = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Information updated.',
                'data'    => $information->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Information deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Information deleted.');
    }
}
