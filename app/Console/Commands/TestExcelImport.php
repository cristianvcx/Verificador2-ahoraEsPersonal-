<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ExcelImporterService;

class TestExcelImport extends Command
{
    /**
     * El comando de consola para probar la importación.
     */
    protected $signature = 'import:test {file}';

    /**
     * Descripción del comando.
     */
    protected $description = 'Prueba la lectura y asignación automática de un archivo XLSX';

    /**
     * Ejecuta el comando.
     */
    public function handle(ExcelImporterService $service): int
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("El archivo no existe en la ruta especificada: {$file}");
            return 1;
        }

        $this->info("Iniciando lectura de: {$file}...");

        try {
            $data = $service->parseXlsx($file);

            $headers = $data['headers'];
            $rows = $data['rows'];
            $total = count($rows);

            $this->info("¡Éxito! Total de registros encontrados: {$total}");

            // Tomar una muestra de las primeras 5 filas para renderizar una tabla de control
            $sample = array_slice($rows, 0, 5);

            $this->table($headers, $sample);

            $noMatchCount = collect($rows)->whereNull('unidad_id_asignada')->count();
            if ($noMatchCount > 0) {
                $this->warn("Advertencia: {$noMatchCount} filas no pudieron emparejarse con ninguna unidad de la base de datos.");
            } else {
                $this->info("¡Perfecto! Todas las filas se emparejaron con una unidad registrada.");
            }
        } catch (\Exception $e) {
            $this->error("Fallo al procesar: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
