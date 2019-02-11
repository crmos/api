<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\BaseController;
use App\Modules\Authentication\Role\Repositories\RoleRepository;
use App\Modules\Authentication\User\Repositories\UserRepository;
use App\Modules\Authentication\User\Requests\CreateUserRequest;
use App\Modules\Authentication\User\Requests\UpdateUserRequest;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BaseController
{
    private $userRepository, $roleRepository, $log;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param Log $log
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, Log $log)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->log = $log;
        parent::__construct();
    }


    /**
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('read',$this->userRepository->getModel());
        if(\request()->ajax()) {
            $users = $this->userRepository->getAllForDataTable();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $data = $user;
                    $name = 'dashboard.users';
                    $view = true;
                    return $this->view('partials.common.action', compact('data', 'name', 'view'))->render();
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);

        }
        return $this->view('acl.user.index', compact('users'));
    }

    /**
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create',$this->userRepository->getModel());
        return $this->view('acl.user.create');
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUserRequest $createUserRequest)
    {
        $this->authorize('create',$this->userRepository->getModel());
        $data = $createUserRequest->all();
        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepository->create($data);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'User added successfully');
            return redirect()->route('dashboard.users.index');
        }
        catch (\Exception $e) {
            $this->log->error('User create : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('read', $this->userRepository->getModel());
        $user = $this->userRepository->findById($id);
        return $this->view('acl.user.show', compact('user'));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $user = $this->userRepository->findById($id);
        return $this->view('acl.user.edit', compact('user'));
    }


    public function update(UpdateUserRequest $updateUserRequest, $id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $data = $updateUserRequest->all();
        if(isset($data['email'])) {
            unset($data['email']);
        }
        try {
            $user = $this->userRepository->findById($id);
            if(isset($data['password']) && !is_null($data['password']))
            {
                $data['password_reference'] = $data['password'];
                $data['password'] = bcrypt($data['password']);
            }
            else {
                unset($data['password']);
            }
            $user = $this->userRepository->update($data, $id);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'User updated successfully');
            return redirect()->route('dashboard.users.index');
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id, Request $request)
    {
        $this->authorize('delete',$this->userRepository->getModel());
        try {
            if(isset($request->hard_delete))
                $this->userRepository->hardDelete($id);
            else
                $this->userRepository->delete($id);

            session()->flash('success', 'User deleted successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User delete : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function approve(Request $request, $id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $data = $request->only('status');
        try {
            $user = $this->userRepository->update($data, $id);
            session()->flash('success', 'User Activated successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /**
     * @return mixed
     */
    public function getProfile()
    {
        $id = Auth::id();
        $user = $this->userRepository->findById($id);
        return $this->view('acl.user.profile', compact('user'));
    }

    public function postProfile(UpdateUserRequest $updateUserRequest)
    {
        $user = Auth::user();
        $data = $updateUserRequest->all();
        if(isset($data['email'])) {
            unset($data['email']);
        }
        $data['role'] = $user->mainRole()?$user->mainRole()->id:null;
        try {
            $user = $this->userRepository->findById($user->id);
            if(isset($data['password']) && !is_null($data['password']))
            {
                if(!Hash::check($data['old_password'], $user->password))
                {
                    session()->flash('warning', 'Old password does not match');
                    return redirect()->back();
                }
                else {
                    $data['password'] = bcrypt($data['password']);
                }
            }
            else {
                unset($data['password']);
            }
            $user = $this->userRepository->update($data, $user->id);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Profile updated successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


}
