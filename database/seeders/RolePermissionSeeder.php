<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view schools',
            'create schools',
            'update schools',
            'delete schools',

            'view teachers',
            'create teachers',
            'update teachers',
            'delete teachers',

            'view students',
            'create students',
            'update students',
            'delete students',

            'view enrollments',
            'create enrollments',
            'update enrollments',
            'delete enrollments',

            'view scores',
            'create scores',
            'update scores',
            'delete scores',
            'publish scores',

            'view indicators',
            'create indicators',
            'update indicators',
            'delete indicators',

            'view imports',
            'create imports',
            'approve imports',
            'reject imports',

            'view reports',
            'export reports',

            'view maintenance',
            'create maintenance',
            'update maintenance',
            'delete maintenance',

            'view audit logs',
            'manage users',
            'manage roles',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $superAdmin = Role::findOrCreate('Super Admin');
        $superAdmin->syncPermissions($permissions);

        $lgeaAdmin = Role::findOrCreate('LGEA Admin');
        $lgeaAdmin->syncPermissions([
            'view schools', 'create schools', 'update schools',
            'view teachers', 'create teachers', 'update teachers',
            'view students', 'create students', 'update students',
            'view enrollments', 'create enrollments', 'update enrollments',
            'view scores', 'create scores', 'update scores', 'publish scores',
            'view indicators', 'create indicators', 'update indicators',
            'view imports', 'create imports', 'approve imports', 'reject imports',
            'view reports', 'export reports',
            'view maintenance', 'create maintenance', 'update maintenance',
            'view audit logs',
        ]);

        $headTeacher = Role::findOrCreate('Head Teacher');
        $headTeacher->syncPermissions([
            'view teachers', 'create teachers', 'update teachers',
            'view students', 'create students', 'update students',
            'view enrollments', 'create enrollments', 'update enrollments',
            'view scores', 'create scores', 'update scores', 'publish scores',
            'view reports',
            'view maintenance', 'create maintenance', 'update maintenance',
        ]);

        $resultOfficer = Role::findOrCreate('Result Officer');
        $resultOfficer->syncPermissions([
            'view students',
            'view enrollments',
            'view scores', 'create scores', 'update scores',
            'view reports',
        ]);

        $emisOfficer = Role::findOrCreate('EMIS Officer');
        $emisOfficer->syncPermissions([
            'view indicators', 'create indicators', 'update indicators',
            'view imports', 'create imports', 'approve imports',
            'view reports', 'export reports',
        ]);

        $dataEntry = Role::findOrCreate('Data Entry Clerk');
        $dataEntry->syncPermissions([
            'view schools',
            'view teachers', 'create teachers', 'update teachers',
            'view students', 'create students', 'update students',
            'view enrollments', 'create enrollments', 'update enrollments',
            'view maintenance', 'create maintenance', 'update maintenance',
        ]);
    }
}