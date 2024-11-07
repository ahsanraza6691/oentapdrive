<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Str;

class VendorRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($request)
    {
        $this->model->name                   = $request->name;
        $this->model->company_name           = $request->company_name;
        $this->model->slug                   = Str::slug($request->company_name, "-");
        $this->model->job_title              = $request->job_title;
        $this->model->fleet_size             = $request->fleet_size;
        $this->model->contact                = $request->contact;
        $this->model->email                  = $request->email;
        $this->model->country                = $request->country;
        $this->model->city                   = $request->city;
        $this->model->active_car_count_limit = 20;
        $this->model->role                   = 2;
        $this->model->status                 = 0;

        if ($request->company_logo) {
            $filename = time(). '-'.Str::slug($request->company_name) . '.' . $request->company_logo->extension();
            $request->company_logo->move(public_path('company_logo'), $filename);
            $this->model->company_logo = $filename;
        }
        if ($request->company_license) {
            $filename = time(). '-'.Str::slug($request->company_name) . '.' . $request->company_license->extension();
            $request->company_license->move(public_path('company_license'), $filename);
            $this->model->company_license = $filename;
        }
        $this->model->save();
        return $this->model;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }
        return null;
    }
}
