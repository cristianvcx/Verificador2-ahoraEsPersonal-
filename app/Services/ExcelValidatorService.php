<?php

namespace App\Services;

class ExcelValidatorService
{
  public function validateActividad(array $data): void
  {

    // validar match de headers
    $ACTIVIDAD_HEADERS = [
      'CONSIDERAR_SI_NO',
      'MODALIDAD_MODIFICADO',
      'MODALIDAD_COD',
      'TIPO_MODIFICADO',
      'TIPO_ACT_COD',
      'CAJ_ID',
      'SUB_TIPO_MODIFICADO',
      'SUB_TIPO_COD',
      'COD',
      'FECHA',
      'FECHA_SAJ',
      'MODALIDAD',
      'TIPO_ACTIVIDAD',
      'SUB_TIPO_ACTIVIDAD',
      'PARTICIPANTES',
      'TOTAL_HOMBRES',
      'TOTAL_MUJERES',
      'TOTAL_NOBINARIO',
      'FUNCIONARIO',
      'UNIDAD',
      'TIPO_UNIDAD',
      'REGION',
      'MES',
      'AÑO',
      'DET_ACTIVIDAD',
    ];

    $missing = array_diff(
      $ACTIVIDAD_HEADERS,
      $data['headers']
    );

    if (!empty($missing)) {
      throw new \Exception(
        'Faltan columnas requeridas: '
          . implode(', ', $missing)
      );
    }

    // validar rows no vacias
    if ($data['rows'] === []) {
      throw new \Exception('No hay filas de datos para validar.');
    }

    //TO-DO validar que no hayan celdas vacías en columnas críticas como UNIDAD, TIPO_ACTIVIDAD, etc.
  }
}
