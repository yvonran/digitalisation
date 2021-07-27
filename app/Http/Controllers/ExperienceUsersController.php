<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ExperienceUserCreateRequest;
use App\Http\Requests\ExperienceUserUpdateRequest;
use App\Repositories\Interfaces\ExperienceUserRepository;
use App\Repositories\Validators\ExperienceUserValidator;

/**
 * Class ExperienceUsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ExperienceUsersController extends Controller
{
    /**
     * @var ExperienceUserRepository
     */
    protected $repository;

    /**
     * @var ExperienceUserValidator
     */
    protected $validator;

    /**
     * ExperienceUsersController constructor.
     *
     * @param ExperienceUserRepository $repository
     * @param ExperienceUserValidator $validator
     */
    public function __construct(ExperienceUserRepository $repository, ExperienceUserValidator $validator)
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
        $experienceUsers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $experienceUsers,
            ]);
        }

        return view('experienceUsers.index', compact('experienceUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExperienceUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ExperienceUserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $experienceUser = $this->repository->create($request->all());

            $response = [
                'message' => 'ExperienceUser created.',
                'data'    => $experienceUser->toArray(),
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
        $experienceUser = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $experienceUser,
            ]);
        }

        return view('experienceUsers.show', compact('experienceUser'));
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
        $experienceUser = $this->repository->find($id);

        return view('experienceUsers.edit', compact('experienceUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExperienceUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ExperienceUserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $experienceUser = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ExperienceUser updated.',
                'data'    => $experienceUser->toArray(),
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
                'message' => 'ExperienceUser deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ExperienceUser deleted.');
    }
}
