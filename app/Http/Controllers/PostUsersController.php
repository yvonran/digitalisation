<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PostUserCreateRequest;
use App\Http\Requests\PostUserUpdateRequest;
use App\Repositories\Interfaces\PostUserRepository;
use App\Repositories\Validators\PostUserValidator;

/**
 * Class PostUsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostUsersController extends Controller
{
    /**
     * @var PostUserRepository
     */
    protected $repository;

    /**
     * @var PostUserValidator
     */
    protected $validator;

    /**
     * PostUsersController constructor.
     *
     * @param PostUserRepository $repository
     * @param PostUserValidator $validator
     */
    public function __construct(PostUserRepository $repository, PostUserValidator $validator)
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
        $postUsers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $postUsers,
            ]);
        }

        return view('postUsers.index', compact('postUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PostUserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $postUser = $this->repository->create($request->all());

            $response = [
                'message' => 'PostUser created.',
                'data'    => $postUser->toArray(),
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
        $postUser = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $postUser,
            ]);
        }

        return view('postUsers.show', compact('postUser'));
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
        $postUser = $this->repository->find($id);

        return view('postUsers.edit', compact('postUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PostUserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $postUser = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PostUser updated.',
                'data'    => $postUser->toArray(),
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
                'message' => 'PostUser deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PostUser deleted.');
    }
}
