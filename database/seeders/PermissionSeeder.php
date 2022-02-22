<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission =[
            ["name" => 'permission.show', "title" => 'Ver permissões', "guard_name" => 'web'],
            ["name" => 'permission.edit', "title" => 'Alterar permissões', "guard_name" => 'web'],
            ["name" => 'permission.add', "title" => 'Adicionar novas permissões', "guard_name" => 'web'],
            ["name" => 'permission.delete', "title" => 'Excluir permissões', "guard_name" => 'web'],

            ["name" => 'roles.show', "title" => 'Ver funções', "guard_name" => 'web'],
            ["name" => 'roles.edit', "title" => 'Alterar funções', "guard_name" => 'web'],
            ["name" => 'roles.add', "title" => 'Adicionar funções', "guard_name" => 'web'],
            ["name" => 'roles.delete', "title" => 'Excluir funções', "guard_name" => 'web'],

            ["name" => 'user.show', "title" => 'Ver usuários', "guard_name" => 'web'],
            ["name" => 'user.edit', "title" => 'Editar usuários', "guard_name" => 'web'],
            ["name" => 'user.add', "title" => 'Adicionar novos usuários', "guard_name" => 'web'],
            ["name" => 'user.delete', "title" => 'Excluir usuários', "guard_name" => 'web'],
            ["name" => 'api-user.add', "title" => 'Adicionar ApiUser', "guard_name" => 'web'],
            ["name" => 'api-user.view', "title" => 'Ver ApiUser', "guard_name" => 'web'],
            ["name" => 'api-user.edit', "title" => 'Editar ApiUser', "guard_name" => 'web'],
            ["name" => 'api-user-passport.view', "title" => 'Visualização de senha do usuário da API', "guard_name" => 'web'],

            ["name" => 'manage.show', "title" => 'Ver menu gestão', "guard_name" => 'web'],

            ["name" => 'plano.show', "title" => 'Ver menu planos', "guard_name" => 'web'],
            ["name" => 'plano.edit', "title" => 'Editar planos', "guard_name" => 'web'],
            ["name" => 'plano.add', "title" => 'Adicionar novos planos', "guard_name" => 'web'],
            ["name" => 'plano.delete', "title" => 'Excluir planos', "guard_name" => 'web'],

            ["name" => 'taxa.show', "title" => 'Ver menu taxa', "guard_name" => 'web'],
            ["name" => 'taxa.edit', "title" => 'Editar taxa', "guard_name" => 'web'],
            ["name" => 'taxa.add', "title" => 'Adicionar novas taxas', "guard_name" => 'web'],
            ["name" => 'taxa.delete', "title" => 'Excluir planos', "guard_name" => 'web'],

        ];

        DB::table('permissions')->insert($permission);
    }
}
