<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with core types and Excel units.
     */
    public function run(): void
    {
        // 1. Poblar Tipos de Unidad (unidad_tipo) basado en los tipos del Excel
        $tipos = [
            ['unidad_tipo_desc' => 'Corporación de Asistencia Judicial', 'nombre_corto' => 'CJ'],
            ['unidad_tipo_desc' => 'Centro de Mediación', 'nombre_corto' => 'MED'],
            ['unidad_tipo_desc' => 'Oficina de Defensa Laboral', 'nombre_corto' => 'ODL'],
            ['unidad_tipo_desc' => 'Oficina Niñez y Adolescencia', 'nombre_corto' => 'NAD'],
            ['unidad_tipo_desc' => 'Programa Mi Abogado', 'nombre_corto' => 'PMA'],
            ['unidad_tipo_desc' => 'Programa Adulto Mayor', 'nombre_corto' => 'PAM'],
            ['unidad_tipo_desc' => 'Centro de Apoyo a Víctimas', 'nombre_corto' => 'CAVI'],
        ];

        foreach ($tipos as $tipo) {
            DB::table('unidad_tipo')->updateOrInsert(
                ['nombre_corto' => $tipo['nombre_corto']],
                ['unidad_tipo_desc' => $tipo['unidad_tipo_desc']]
            );
        }

        // Obtener los IDs autogenerados de los tipos de unidad
        $tipoIds = DB::table('unidad_tipo')->pluck('unidad_tipo_id', 'nombre_corto');

        // 2. Poblar Unidades Operativas (unidad) con el listado oficial extraído del Excel
        $unidades = [
            ['UNIDAD MÓVIL COSTA', 'CJ'],
            ['UNIDAD MÓVIL CAUTÍN', 'CJ'],
            ['UNIDAD MÓVIL MALLECO', 'CJ'],
            ['CAJ ALTO BIO BIO', 'CJ'],
            ['UNIDAD MOVIL CONCEPCION', 'CJ'],
            ['CENTRO MEDIACION TEMUCO', 'MED'],
            ['CAJ FAMILIA PUERTO MONTT', 'CJ'],
            ['ODL LOS ANGELES', 'ODL'],
            ['CAJ TEMUCO FAMILIA', 'CJ'],
            ['ODL AYSÉN', 'ODL'],
            ['CAJ LOS ALAMOS', 'CJ'],
            ['ODL CHILLAN', 'ODL'],
            ['NAD CHILLAN', 'NAD'],
            ['PMA ARAUCANIA', 'PMA'],
            ['PMA CHILLÁN', 'PMA'],
            ['CAJ LONCOCHE', 'CJ'],
            ['ODL CASTRO', 'ODL'],
            ['PAM LOS LAGOS', 'PAM'],
            ['ODL COYHAIQUE', 'ODL'],
            ['CAJ COYHAIQUE', 'CJ'],
            ['CAJ CHILE CHICO', 'CJ'],
            ['CAVI COYHAIQUE', 'CAVI'],
            ['NAD COYHAIQUE', 'NAD'],
            ['PAM LOS RÍOS', 'PAM'],
            ['CAJ QUIRIHUE', 'CJ'],
            ['CAJ CHILLAN FAMILIA', 'CJ'],
            ['PMA LOS RÍOS', 'PMA'],
            ['CAJ COCHRANE', 'CJ'],
            ['CAJ PUERTO AYSEN', 'CJ'],
            ['CAJ TRAIGUEN', 'CJ'],
            ['CAJ ARAUCO', 'CJ'],
            ['CAJ LEBU', 'CJ'],
            ['CAJ ANGOL', 'CJ'],
            ['ODL PUERTO MONTT', 'ODL'],
            ['PAM AYSÉN', 'PAM'],
            ['CAJ CONCEPCION FAMILIA', 'CJ'],
            ['CAJ PANGUIPULLI', 'CJ'],
            ['CAJ CASTRO', 'CJ'],
            ['CAJ LOTA', 'CJ'],
            ['CAJ PENCO', 'CJ'],
            ['PMA LOS LAGOS', 'PMA'],
            ['CAJ PURRANQUE', 'CJ'],
            ['CAJ CURACAUTIN', 'CJ'],
            ['CAJ BARRIO NORTE', 'CJ'],
            ['CAJ NUEVA IMPERIAL', 'CJ'],
            ['CAJ CURARREHUE', 'CJ'],
            ['CAJ FAM LOS ANGELES', 'CJ'],
            ['CAJ CAÑETE', 'CJ'],
            ['CENTRO MEDIACION CONCEPCION', 'MED'],
            ['CAJ TOME', 'CJ'],
            ['CAJ LOS SAUCES', 'CJ'],
            ['CAVI TEMUCO', 'CAVI'],
            ['CAJ COELEMU', 'CJ'],
            ['CAJ CHIGUAYANTE', 'CJ'],
            ['CAJ PUERTO CISNES', 'CJ'],
            ['NAD ANGOL', 'NAD'],
            ['NAD CONCEPCIÓN', 'NAD'],
            ['PMA AYSEN', 'PMA'],
            ['PMA CONCEPCIÓN', 'PMA'],
        ];

        foreach ($unidades as $u) {
            $nombre = $u[0];
            $tipoCorto = $u[1];
            $tipoId = $tipoIds[$tipoCorto] ?? null;

            DB::table('unidad')->updateOrInsert(
                ['unidad_nombre' => $nombre],
                [
                    'unidad_tipo_id' => $tipoId,
                    'unidad_correo' => strtolower(str_replace(' ', '', $nombre)) . '@cajbiobio.cl',
                ]
            );
        }
    }
}