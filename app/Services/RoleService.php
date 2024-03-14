<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleService
{
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
    }

    public function getPaginate($perPage, $page, array $search): LengthAwarePaginator
    {
        return $this->roleRepository->paginate($perPage, $page, $search);
    }

    public function createRole(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    public function findRole(string $id): ?Role
    {
        $role = $this->roleRepository->find($id);

        if (is_null($role)) throw new NotFoundHttpException('');

        return $role;
    }

    public function updateRole(Role $role, array $data): Role
    {
        return $this->roleRepository->update($role, $data);
    }

    public function deleteRole(Role $role): Role
    {
        return $this->roleRepository->delete($role);
    }
}
