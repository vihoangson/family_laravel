<?php

namespace App\Http\Controllers;

use App\Repositories\CelebrationRepository2;
use App\Repositories\CelebrationRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CelebrationCreateRequest;
use App\Http\Requests\CelebrationUpdateRequest;
use App\Repositories\CelebrationRepository;
use App\Validators\CelebrationValidator;

/**
 * Class CelebrationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CelebrationsController extends Controller
{
    /**
     * @var CelebrationRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CelebrationValidator
     */
    protected $validator;

    /**
     * CelebrationsController constructor.
     *
     * @param CelebrationRepository2 $repository2
     * @param CelebrationRepository  $repository
     * @param CelebrationValidator   $validator
     */
    public function __construct(CelebrationRepository $repository, CelebrationValidator $validator,CelebrationRepository2 $repository2)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->validator  = $validator;
        echo $this->repository2->run_s();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $celebrations = $this->repository->all();
$m = $this->repository->getSpecial();
dd($m);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $celebrations,
            ]);
        }

        return view('celebrations.index', compact('celebrations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CelebrationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CelebrationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $celebration = $this->repository->create($request->all());

            $response = [
                'message' => 'Celebration created.',
                'data'    => $celebration->toArray(),
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
        $celebration = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $celebration,
            ]);
        }

        return view('celebrations.show', compact('celebration'));
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
        $celebration = $this->repository->find($id);

        return view('celebrations.edit', compact('celebration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CelebrationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CelebrationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $celebration = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Celebration updated.',
                'data'    => $celebration->toArray(),
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
                'message' => 'Celebration deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Celebration deleted.');
    }
}
