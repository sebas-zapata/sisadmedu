<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW `vista_usuario_roles` AS select `sisadmedu`.`usuarios`.`id_usuario` AS `id_usuario`,`sisadmedu`.`usuarios`.`documento_usuario` AS `documento_usuario`,`sisadmedu`.`usuarios`.`nombres_usuario` AS `nombres_usuario`,`sisadmedu`.`usuarios`.`apellidos_usuario` AS `apellidos_usuario`,`sisadmedu`.`usuarios`.`correo_electronico_usuario` AS `correo_electronico_usuario`,`sisadmedu`.`usuarios`.`telefono_usuario` AS `telefono_usuario`,`sisadmedu`.`rol`.`rol` AS `nombre_rol` from (`sisadmedu`.`usuarios` join `sisadmedu`.`rol` on(`sisadmedu`.`usuarios`.`rol_id_rol` = `sisadmedu`.`rol`.`id_rol`))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `vista_usuario_roles`");
    }
};
