<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database with core types and Excel units.
     */
    public function run(): void
    {

        $unidades = [
            [
                "CAJ ALTO BIO BIO",
                "caltobiobio@cajbiobio.cl"
            ],
            [
                "CAJ ANCUD",
                "cancud@cajbiobio.cl"
            ],
            [
                "CAJ ANGOL",
                "cangol@cajbiobio.cl"
            ],
            [
                "NAD ANGOL",
                "nadaraucania@cajbiobio.cl"
            ],
            [
                "ODL ANGOL",
                "odlangol@cajbiobio.cl"
            ],
            [
                "CAJ ANTUCO",
                "cantuco@cajbiobio.cl"
            ],
            [
                "CAJ ARAUCO",
                "carauco@cajbiobio.cl"
            ],
            [
                "CAJ PUERTO AYSEN",
                "caysen@cajbiobio.cl"
            ],
            [
                "NAD AYSÉN",
                "curadoresaysen@cajbiobio.cl"
            ],
            [
                "ODL AYSÉN",
                "odlaysen@cajbiobio.cl"
            ],
            [
                "PAM AYSÉN",
                "pamaysen@cajbiobio.cl"
            ],
            [
                "CAJ BULNES",
                "cbulnes@cajbiobio.cl"
            ],
            [
                "CAJ CABRERO",
                "ccabrero@cajbiobio.cl"
            ],
            [
                "CAJ CALBUCO",
                "ccalbuco@cajbiobio.cl"
            ],
            [
                "CAJ CARAHUE",
                "ccarahue@cajbiobio.cl"
            ],
            [
                "CAJ CASTRO",
                "ccastro@cajbiobio.cl"
            ],
            [
                "CONSULTORIO JURÍDICO MÓVIL CASTRO",
                "movilcastro@cajbiobio.cl"
            ],
            [
                "NAD CASTRO",
                "nadloslagos@cajbiobio.cl"
            ],
            [
                "ODL CASTRO",
                "odlcastro@cajbiobio.cl"
            ],
            [
                "CAJ CAÑETE",
                "ccanete@cajbiobio.cl"
            ],
            [
                "CONSULTORIO JURIDICO MÓVIL CONTULMO TIRUA",
                "movilcontulmotirua@cajbiobio.cl"
            ],
            [
                "CAJ CHAITEN",
                "cchaiten@cajbiobio.cl"
            ],
            [
                "CAJ CHIGUAYANTE",
                "cchiguayante@cajbiobio.cl"
            ],
            [
                "CAJ CHILE CHICO",
                "cchilechico@cajbiobio.cl"
            ],
            [
                "CAJ CHILLAN CIVIL",
                "cchillan@cajbiobio.cl"
            ],
            [
                "CAJ CHILLAN FAMILIA",
                "cfamiliachillan@cajbiobio.cl"
            ],
            [
                "CAJ HUEPIL",
                "ctucapel@cajbiobio.cl"
            ],
            [
                "CAVI CHILLÁN",
                "caivchillan@cajbiobio.cl"
            ],
            [
                "CENTRO MEDIACION CHILLAN",
                "mediacionchillan@cajbiobio.cl"
            ],
            [
                "DIRECCIÓN REGIONAL ÑUBLE",
                "dirnuble@cajbiobio.cl"
            ],
            [
                "NAD CHILLÁN",
                "curadoresnuble@cajbiobio.cl"
            ],
            [
                "ODL CHILLAN",
                "odlchillan@cajbiobio.cl"
            ],
            [
                "OFICINA SEGUNDA INSTANCIA CHILLAN",
                "segundainstanciachillan@cajbiobio.cl"
            ],
            [
                "PAM CHILLÁN",
                "pamchillan@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO CHILLAN",
                "miabogadonuble@cajbiobio.cl"
            ],
            [
                "CAJ CHILLAN VIEJO",
                "cchillanviejo@cajbiobio.cl"
            ],
            [
                "CAJ CHOLCHOL",
                "ccholchol@cajbiobio.cl"
            ],
            [
                "CAJ PUERTO CISNES",
                "cpuertocisnes@cajbiobio.cl"
            ],
            [
                "CAJ COBQUECURA",
                "ccobquecura@cajbiobio.cl"
            ],
            [
                "CAJ COCHRANE",
                "ccochrane@cajbiobio.cl"
            ],
            [
                "CAJ COELEMU",
                "ccoelemu@cajbiobio.cl"
            ],
            [
                "CAJ COIHUECO",
                "ccoihueco@cajbiobio.cl"
            ],
            [
                "CAJ COLLIPULLI",
                "ccollipulli@cajbiobio.cl"
            ],
            [
                "CAJ BARRIO NORTE",
                "cbarrionorte@cajbiobio.cl"
            ],
            [
                "CAJ CONCEPCION CIVIL",
                "cconcepcion@cajbiobio.cl"
            ],
            [
                "CAJ CONCEPCION FAMILIA",
                "cfamiliaconcepcion@cajbiobio.cl"
            ],
            [
                "CAJ CONCEPCION PENAL INFRA",
                "penalinfraccional@cajbiobio.cl"
            ],
            [
                "CAVI CONCEPCION",
                "caviprovinciaconcepcion@cajbiobio.cl"
            ],
            [
                "CENTRO MEDIACION CONCEPCION",
                "mediacion@cajbiobio.cl"
            ],
            [
                "DIRECCION GENERAL",
                "oirs@cajbiobio.cl"
            ],
            [
                "NAD CONCEPCIÓN",
                "nadbiobio@cajbiobio.cl"
            ],
            [
                "ODL CONCEPCIÓN",
                "odlconcepcion@cajbiobio.cl"
            ],
            [
                "OFICINA SEGUNDA INSTANCIA CONCEPCION",
                "segundainstanciaconcepcion@cajbiobio.cl"
            ],
            [
                "PAM CONCEPCIÓN",
                "pamconcepcion@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO CONCEPCIÓN",
                "miabogadobiobio@cajbiobio.cl"
            ],
            [
                "UNIDAD MÓVIL CONCEPCION",
                "movilconcepcion@cajbiobio.cl"
            ],
            [
                "CAJ CORONEL",
                "ccoronel@cajbiobio.cl"
            ],
            [
                "CAJ CORRAL",
                "ccorral@cajbiobio.cl"
            ],
            [
                "CAJ COYHAIQUE",
                "ccoyhaique@cajbiobio.cl"
            ],
            [
                "CAVI COYHAIQUE",
                "caivcoyhaique@cajbiobio.cl"
            ],
            [
                "DIRECCIÓN REGIONAL AYSÉN",
                "dirundecima@cajbiobio.cl"
            ],
            [
                "NAD COYHAIQUE",
                "curadoresaysen@cajbiobio.cl"
            ],
            [
                "ODL COYHAIQUE",
                "odlcoyhaique@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO COYHAIQUE",
                "miabogadoaysen@cajbiobio.cl"
            ],
            [
                "CAJ CUNCO",
                "ccunco@cajbiobio.cl"
            ],
            [
                "CAJ CURACAUTIN",
                "ccuracautin@cajbiobio.cl"
            ],
            [
                "CAJ CURANILAHUE",
                "ccuranilahue@cajbiobio.cl"
            ],
            [
                "NAD CURANILAHUE",
                "nadbiobio@cajbiobio.cl"
            ],
            [
                "CAJ CURARREHUE",
                "ccurarrehue@cajbiobio.cl"
            ],
            [
                "CAJ EL CARMEN",
                "celcarmen@cajbiobio.cl"
            ],
            [
                "CAJ ERCILLA",
                "cercilla@cajbiobio.cl"
            ],
            [
                "CAJ FLORIDA",
                "cflorida@cajbiobio.cl"
            ],
            [
                "CAJ FREIRE",
                "cfreire@cajbiobio.cl"
            ],
            [
                "CAJ FRESIA",
                "cfresia@cajbiobio.cl"
            ],
            [
                "CAJ FRUTILLAR",
                "cfrutillar@cajbiobio.cl"
            ],
            [
                "CAJ FUTALEUFU",
                "cfutaleufu@cajbiobio.cl"
            ],
            [
                "CAJ FUTRONO",
                "cfutrono@cajbiobio.cl"
            ],
            [
                "CAJ GALVARINO",
                "cgalvarino@cajbiobio.cl"
            ],
            [
                "CAJ GORBEA",
                "cgorbea@cajbiobio.cl"
            ],
            [
                "CAJ HUALAIHUE",
                "cptomontt@cajbiobio.cl"
            ],
            [
                "CAJ HUALPEN",
                "chualpen@cajbiobio.cl"
            ],
            [
                "CAJ HUALQUI",
                "chualqui@cajbiobio.cl"
            ],
            [
                "CAJ LA UNIÓN",
                "claunion@cajbiobio.cl"
            ],
            [
                "CAJ LAGO RANCO",
                "clagoranco@cajbiobio.cl"
            ],
            [
                "CAJ LAJA",
                "claja@cajbiobio.cl"
            ],
            [
                "CAJ LANCO",
                "clanco@cajbiobio.cl"
            ],
            [
                "CAJ LAUTARO",
                "clautaro@cajbiobio.cl"
            ],
            [
                "CAJ LEBU",
                "clebu@cajbiobio.cl"
            ],
            [
                "CAJ LONCOCHE",
                "cloncoche@cajbiobio.cl"
            ],
            [
                "CAJ LONQUIMAY",
                "clonquimay@cajbiobio.cl"
            ],
            [
                "CAJ LOS LAGOS",
                "closlagos@cajbiobio.cl"
            ],
            [
                "CAJ LOS MUERMOS",
                "closmuermos@cajbiobio.cl"
            ],
            [
                "CAJ LOS SAUCES",
                "clossauces@cajbiobio.cl"
            ],
            [
                "CAJ LOS ALAMOS",
                "closalamos@cajbiobio.cl"
            ],
            [
                "CAJ CIVIL LOS ANGELES",
                "closangeles@cajbiobio.cl"
            ],
            [
                "CAJ FAM LOS ANGELES",
                "cfamilialosangeles@cajbiobio.cl"
            ],
            [
                "NAD LOS ANGELES",
                "nadbiobio@cajbiobio.cl"
            ],
            [
                "ODL LOS ANGELES",
                "odllosangeles@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO LOS ÁNGELES",
                "miabogadobiobio@cajbiobio.cl"
            ],
            [
                "CAJ LOTA",
                "clota@cajbiobio.cl"
            ],
            [
                "CAJ LUMACO",
                "clumaco@cajbiobio.cl"
            ],
            [
                "CAJ SAN JOSÉ DE LA MARIQUINA",
                "csjmariquina@cajbiobio.cl"
            ],
            [
                "CAJ MAULLIN",
                "cmaullin@cajbiobio.cl"
            ],
            [
                "CAJ MELIPEUCO",
                "cmelipeuco@cajbiobio.cl"
            ],
            [
                "CAJ MULCHEN",
                "cmulchen@cajbiobio.cl"
            ],
            [
                "CAJ MÁFIL",
                "cmafil@cajbiobio.cl"
            ],
            [
                "CAJ NACIMIENTO",
                "cnacimiento@cajbiobio.cl"
            ],
            [
                "CAJ NEGRETE",
                "cnegrete@cajbiobio.cl"
            ],
            [
                "CAJ NINHUE",
                "cninhue@cajbiobio.cl"
            ],
            [
                "CAJ NUEVA IMPERIAL",
                "cnvaimperial@cajbiobio.cl"
            ],
            [
                "CAJ OSORNO",
                "cosorno@cajbiobio.cl"
            ],
            [
                "CONSULTORIO JURÍDICO MÓVIL OSORNO",
                "movosorno@cajbiobio.cl"
            ],
            [
                "NAD OSORNO",
                "nadloslagos@cajbiobio.cl"
            ],
            [
                "ODL OSORNO",
                "odlosorno@cajbiobio.cl"
            ],
            [
                "CAJ PADRE LAS CASAS",
                "cpadrelascasas@cajbiobio.cl"
            ],
            [
                "CAJ PAILLACO",
                "cpaillaco@cajbiobio.cl"
            ],
            [
                "CAJ PALENA",
                "cpalena@cajbiobio.cl"
            ],
            [
                "NAD PALENA",
                "nadloslagos@cajbiobio.cl"
            ],
            [
                "CAJ PANGUIPULLI",
                "cpanguipulli@cajbiobio.cl"
            ],
            [
                "CAJ PEMUCO",
                "cpemuco@cajbiobio.cl"
            ],
            [
                "CAJ PENCO",
                "cpenco@cajbiobio.cl"
            ],
            [
                "CAJ PERQUENCO",
                "cperquenco@cajbiobio.cl"
            ],
            [
                "CAJ PINTO",
                "cpinto@cajbiobio.cl"
            ],
            [
                "CAJ PITRUFQUEN",
                "cpitrufquen@cajbiobio.cl"
            ],
            [
                "CAJ PORTEZUELO",
                "cportezuelo@cajbiobio.cl"
            ],
            [
                "CAJ PUCÓN",
                "cpucon@cajbiobio.cl"
            ],
            [
                "UNIDAD MÓVIL CAUTÍN",
                "movilcautin@cajbiobio.cl"
            ],
            [
                "CAJ CIVIL PUERTO MONTT",
                "cptomontt@cajbiobio.cl"
            ],
            [
                "CAJ FAMILIA PUERTO MONTT",
                "cfamiliaptomontt@cajbiobio.cl"
            ],
            [
                "CAVI PUERTO MONTT",
                "caivptomontt@cajbiobio.cl"
            ],
            [
                "CENTRO MEDIACION PUERTO MONTT",
                "mediacionpmontt@cajbiobio.cl"
            ],
            [
                "DIRECCIÓN REGIONAL LOS LAGOS",
                "dirdecima@cajbiobio.cl"
            ],
            [
                "NAD PUERTO MONTT",
                "nadloslagos@cajbiobio.cl"
            ],
            [
                "ODL PUERTO MONTT",
                "odlpmontt@cajbiobio.cl"
            ],
            [
                "OFICINA SEGUNDA INSTANCIA PUERTO MONTT",
                "segundainstanciapmontt@cajbiobio.cl"
            ],
            [
                "PAM LOS LAGOS",
                "pamloslagos@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO PUERTO MONTT",
                "miabogadoloslagos@cajbiobio.cl"
            ],
            [
                "CAJ PUERTO VARAS",
                "cpuertovaras@cajbiobio.cl"
            ],
            [
                "CAJ PURRANQUE",
                "cpurranque@cajbiobio.cl"
            ],
            [
                "CAJ PUREN",
                "cpuren@cajbiobio.cl"
            ],
            [
                "CAJ QUELLON",
                "cquellon@cajbiobio.cl"
            ],
            [
                "CAJ QUILACO",
                "cquilaco@cajbiobio.cl"
            ],
            [
                "CAJ QUILLECO",
                "cquilleco@cajbiobio.cl"
            ],
            [
                "CAJ QUILLON",
                "cquillon@cajbiobio.cl"
            ],
            [
                "CONSULTORIO JURÍDICO MÓVIL QUINCHAO",
                "cachao@cajbiobio.cl"
            ],
            [
                "CAJ QUIRIHUE",
                "cquirihue@cajbiobio.cl"
            ],
            [
                "CAJ RANQUIL",
                "cranquil@cajbiobio.cl"
            ],
            [
                "CAJ RENAICO",
                "crenaico@cajbiobio.cl"
            ],
            [
                "CAJ RÍO BUENO",
                "criobueno@cajbiobio.cl"
            ],
            [
                "CAJ RIO NEGRO",
                "crionegro@cajbiobio.cl"
            ],
            [
                "CAJ PUERTO SAAVEDRA",
                "cptosaavedra@cajbiobio.cl"
            ],
            [
                "CAJ SAN CARLOS",
                "csancarlos@cajbiobio.cl"
            ],
            [
                "NAD SAN CARLOS",
                "curadoresnuble@cajbiobio.cl"
            ],
            [
                "CAJ SAN IGNACIO",
                "csanignacio@cajbiobio.cl"
            ],
            [
                "CAJ SAN NICOLAS",
                "csannicolas@cajbiobio.cl"
            ],
            [
                "CAJ SAN PEDRO DE LA PAZ",
                "csanpedrodelapaz@cajbiobio.cl"
            ],
            [
                "CAJ SANTA BARBARA",
                "csantabarbara@cajbiobio.cl"
            ],
            [
                "CAJ SANTA JUANA",
                "csantajuana@cajbiobio.cl"
            ],
            [
                "CAJ TALCAHUANO",
                "ctalcahuano@cajbiobio.cl"
            ],
            [
                "CAJ TALCAHUANO FAMILIA",
                "familiatalcahuano@cajbiobio.cl"
            ],
            [
                "CAJ TEMUCO CIVIL",
                "ctemuco@cajbiobio.cl"
            ],
            [
                "CAJ TEMUCO FAMILIA",
                "familiatemuco@cajbiobio.cl"
            ],
            [
                "CAVI TEMUCO",
                "caivtemuco@cajbiobio.cl"
            ],
            [
                "CENTRO MEDIACION TEMUCO",
                "mediaciontemuco@cajbiobio.cl"
            ],
            [
                "DIRECCIÓN REGIONAL ARAUCANÍA",
                "dirnovena@cajbiobio.cl"
            ],
            [
                "NAD TEMUCO",
                "nadaraucania@cajbiobio.cl"
            ],
            [
                "ODL TEMUCO",
                "odltemuco@cajbiobio.cl"
            ],
            [
                "OFICINA SEGUNDA INSTANCIA TEMUCO",
                "segundainstanciatemuco@cajbiobio.cl"
            ],
            [
                "PAM ARAUCANÍA",
                "pamaraucania@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO TEMUCO",
                "miabogadolaaraucania@cajbiobio.cl"
            ],
            [
                "UNIDAD MÓVIL COSTA",
                "movilcosta@cajbiobio.cl"
            ],
            [
                "CAJ TEODORO SCHMIDT",
                "ctschmidt@cajbiobio.cl"
            ],
            [
                "CAJ TOLTÉN",
                "ctolten@cajbiobio.cl"
            ],
            [
                "CAJ TOME",
                "ctome@cajbiobio.cl"
            ],
            [
                "CAJ TRAIGUEN",
                "ctraiguen@cajbiobio.cl"
            ],
            [
                "CAJ TREHUACO",
                "ctrehuaco@cajbiobio.cl"
            ],
            [
                "CAJ VALDIVIA",
                "cvaldivia@cajbiobio.cl"
            ],
            [
                "CAVI VALDIVIA",
                "cavivaldivia@cajbiobio.cl"
            ],
            [
                "DIRECCIÓN REGIONAL LOS RIOS",
                "dirdecimacuarta@cajbiobio.cl"
            ],
            [
                "NAD VALDIVIA",
                "nadlosrios@cajbiobio.cl"
            ],
            [
                "ODL VALDIVIA",
                "odlvaldivia@cajbiobio.cl"
            ],
            [
                "OFICINA SEGUNDA INSTANCIA VALDIVIA",
                "segundainstanciavaldivia@cajbiobio.cl"
            ],
            [
                "PAM LOS RÍOS",
                "pamlosrios@cajbiobio.cl"
            ],
            [
                "PROGRAMA MI ABOGADO VALDIVIA",
                "miabogadolosrios@cajbiobio.cl"
            ],
            [
                "CAJ VICTORIA",
                "cvictoria@cajbiobio.cl"
            ],
            [
                "UNIDAD MÓVIL MALLECO",
                "movilmalleco@cajbiobio.cl"
            ],
            [
                "CAJ VILCUN",
                "cvilcun@cajbiobio.cl"
            ],
            [
                "CAJ VILLARRICA",
                "cvillarrica@cajbiobio.cl"
            ],
            [
                "NAD VILLARRICA",
                "nadaraucania@cajbiobio.cl"
            ],
            [
                "CAJ YUMBEL",
                "cyumbel@cajbiobio.cl"
            ],
            [
                "CAJ YUNGAY",
                "cyungay@cajbiobio.cl"
            ],
            [
                "NAD YUNGAY",
                "curadoresnuble@cajbiobio.cl"
            ],
            [
                "CAJ SAN GREGORIO/ÑIQUEN",
                "csangregorio@cajbiobio.cl"
            ]
        ];

        foreach ($unidades as $u) {
            $nombre = $u[0];

            DB::table('unidad')->updateOrInsert(
                ['unidad_nombre' => $nombre],
                [
                    'unidad_correo' => $u[1],
                ]
            );
        }


        // 4. Poblar Usuarios (Passwords con hash MD5 legado para compatibilidad con AuthController)

        $usuarios = [
            ['nombre' => 'admin_caj', 'correo' => 'admin@cajbiobio.cl', 'rol' => 'admin'],
            ['nombre' => 'cargador_caj', 'correo' => 'cargador@cajbiobio.cl', 'rol' => 'cargador'],
            ['nombre' => 'auditor_caj', 'correo' => 'auditor@cajbiobio.cl', 'rol' => 'auditor'],
            ['nombre' => 'funcionario_caj', 'correo' => 'funcionario@cajbiobio.cl', 'rol' => 'usuario'],
            ['nombre' => 'juan_odl', 'correo' => 'juan.perez@cajbiobio.cl', 'rol' => 'usuario'],
            ['nombre' => 'maria_caj', 'correo' => 'maria.soto@cajbiobio.cl', 'rol' => 'usuario'],
            ['nombre' => 'pedro_nad', 'correo' => 'pedro.gomez@cajbiobio.cl', 'rol' => 'usuario'],
        ];

        foreach ($usuarios as $u) {
            User::factory()->create(
                [
                    'estado' => 1,
                    'name' => $u['nombre'],
                    'email' => $u['correo'],
                    'rol' => $u['rol']
                ]
            );
        }
    }
}
