<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request) 
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 10;

        $roles = Role::paginate($paginate);

        return new RoleResource($roles->load('permissions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions'));

        return response()->json(['message' => 'Role créer avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource($role->load('permissions', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->update($request->validated());

        if ($request->input('permissions')) {
            $role->permissions()->sync($request->input('permissions'));
        }
        return response()->json(['message' => 'Role mise à jour avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = $role->users()->get();
        if ($user->count() == 0) {
            $role->delete();
            return response()->json(['message' => 'Role supprimé avec succès']);
        } else {
            return response()->json(['message' => "Vous ne pouvez pas supprimer ce role"], 403);
        }
    }
}
