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
        DB::statement("CREATE VIEW `vista_docentes_materias` AS select `sisadmedu`.`docentes`.`id_documento_docente` AS `id_documento_docente`,`sisadmedu`.`docentes`.`codigo_docente` AS `codigo_docente`,`sisadmedu`.`docentes`.`primer_nombre_docente` AS `primer_nombre_docente`,`sisadmedu`.`docentes`.`segundo_nombre_docente` AS `segundo_nombre_docente`,`sisadmedu`.`docentes`.`primer_apellido_docente` AS `primer_apellido_docente`,`sisadmedu`.`docentes`.`segundo_apellido_docente` AS `segundo_apellido_docente`,`sisadmedu`.`docentes`.`correo_electronico_docente` AS `correo_electronico_docente`,`sisadmedu`.`materia`.`descripcion_materia` AS `descripcion_materia` from (`sisadmedu`.`docentes` join `sisadmedu`.`materia` on(`sisadmedu`.`docentes`.`id_documento_docente` = `sisadmedu`.`materia`.`docentes_id_documento_docente`))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `vista_docentes_materias`");
    }
};
