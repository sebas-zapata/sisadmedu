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
        DB::statement("CREATE VIEW `vista_estudiantes_grados` AS select `sisadmedu`.`estudiantes`.`id_documento_estudiante` AS `id_documento_estudiante`,`sisadmedu`.`estudiantes`.`codigo_estudiante` AS `codigo_estudiante`,`sisadmedu`.`estudiantes`.`primer_nombre_estudiante` AS `primer_nombre_estudiante`,`sisadmedu`.`estudiantes`.`segundo_nombre_estudiante` AS `segundo_nombre_estudiante`,`sisadmedu`.`estudiantes`.`primer_apellido_estudiante` AS `primer_apellido_estudiante`,`sisadmedu`.`estudiantes`.`segundo_apellido_estudiante` AS `segundo_apellido_estudiante`,`sisadmedu`.`estudiantes`.`edad_estudiante` AS `edad_estudiante`,`sisadmedu`.`estudiantes`.`correo_electronico_estudiante` AS `correo_electronico_estudiante`,`sisadmedu`.`grado`.`nombre_grado` AS `nombre_grado` from (`sisadmedu`.`estudiantes` join `sisadmedu`.`grado` on(`sisadmedu`.`estudiantes`.`grupo_grado_id_grado` = `sisadmedu`.`grado`.`id_grado`))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `vista_estudiantes_grados`");
    }
};
