@extends('layouts.app')

@section('title', 'Registrar Actividad - FirmaGob')

@section('breadcrumbs')
    <a href="#">Actividades</a>
    <span class="separator">‣</span>
    <span>Registrar Actividad</span>
@endsection

@section('sidebar_menu')
    <li>
        <a href="{{ route('actividades.create') }}" class="active">Registrar Actividad</a>
    </li>
    <li>
        <a href="#">Consultar</a>
    </li>
@endsection

@section('content')
    <div class="panel-header-section">
        <h2>Registrar Nueva Actividad Institucional</h2>
        <p style="margin: 5px 0 0; color: var(--color-text-light); font-size: 0.95rem;">
            Complete el siguiente formulario para dejar registro de la actividad realizada. Todos los campos de
            texto tienen límites de caracteres para asegurar el orden público del reporte.
        </p>
    </div>

    <form id="actividadForm" action="{{ route('actividades.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid-columns-2">
            <div class="form-group-item">
                <label for="region">Región</label>
                <select name="region" id="region" class="form-select-control" required>
                    <option value="">Seleccione una región...</option>
                    <option value="Región Metropolitana">Región Metropolitana</option>
                    <option value="Región de Valparaíso">Región de Valparaíso</option>
                    <option value="Región del Biobío">Región del Biobío</option>
                    <option value="Región de Antofagasta">Región de Antofagasta</option>
                    <option value="Región de la Araucanía">Región de la Araucanía</option>
                </select>
            </div>

            <div class="form-group-item">
                <label for="tipo_unidad">Tipo de Unidad</label>
                <select name="tipo_unidad" id="tipo_unidad" class="form-select-control" required>
                    <option value="">Seleccione tipo unidad...</option>
                    <option value="División Tecnológica">División Tecnológica</option>
                    <option value="Departamento de Operaciones">Departamento de Operaciones</option>
                    <option value="Oficina de Atención Ciudadana">Oficina de Atención Ciudadana</option>
                    <option value="Dirección Nacional">Dirección Nacional</option>
                </select>
            </div>
        </div>

        <div class="form-grid-columns-2">
            <div class="form-group-item">
                <label for="unidad_operativa">Unidad Operativa</label>
                <input type="text" name="unidad_operativa" id="unidad_operativa" class="form-input-control" placeholder="Ej: Unidad de Ciberseguridad" required>
            </div>

            <div class="form-group-item">
                <label for="tipo">Tipo de Actividad</label>
                <select name="tipo" id="tipo" class="form-select-control" required>
                    <option value="">Seleccione un tipo...</option>
                    <option value="Capacitación Interna">Capacitación Interna</option>
                    <option value="Reunión Bilateral">Reunión Bilateral</option>
                    <option value="Auditoría de Control">Auditoría de Control</option>
                    <option value="Despliegue en Terreno">Despliegue en Terreno</option>
                </select>
            </div>
        </div>

        <div class="form-group-item">
            <label for="nombre_actividad">Nombre de la Actividad (Máx. 100 caracteres)</label>
            <input type="text" name="nombre_actividad" id="nombre_actividad" class="form-input-control" maxlength="100" placeholder="Ingrese nombre descriptivo de la actividad" required>
        </div>

        <div class="form-group-item">
            <label for="objetivo">Objetivo de la Actividad (La Firma Electrónica) (Máx. 200 caracteres)</label>
            <textarea name="objetivo" id="objetivo" class="form-input-control" maxlength="200" rows="3" placeholder="Describa el objetivo principal del reporte..." required></textarea>
        </div>

        <div class="form-grid-columns-2">
            <div class="form-group-item">
                <label for="n_participantes">Número de Participantes</label>
                <input type="number" name="n_participantes" id="n_participantes" class="form-input-control" min="1" required>
            </div>

            <div class="form-group-item">
                <label for="fecha_actividad">Fecha de Realización</label>
                <input type="date" name="fecha_actividad" id="fecha_actividad" class="form-input-control" required>
            </div>
        </div>

        <div class="form-group-item">
            <label for="ubicacion">Ubicación física o Enlace Virtual (Máx. 150 caracteres)</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-input-control" maxlength="150" placeholder="Ej: Auditorio del Piso 4 o Enlace de Teams" required>
        </div>

        <div class="form-group-item">
            <label for="observacion">Observaciones Adicionales (Máx. 200 caracteres)</label>
            <textarea name="observacion" id="observacion" class="form-input-control" maxlength="200" rows="3" placeholder="Ingrese cualquier observación pertinente..."></textarea>
        </div>

        <!-- Zona de Arrastrar y Soltar Archivo Respaldado (Drag and Drop) -->
        <div class="form-group-item" style="margin-top: 30px;">
            <label>
                Archivos de Respaldo Firmados
                (PDF, DOCX, XLS, JPG, PNG - Máx. 5MB c/u)
            </label>

            <div id="dropzone" class="drag-drop-file-zone" onclick="document.getElementById('archivo').click()">
                <div class="file-zone-icon">⇪</div>
                <p style="margin: 0; font-weight: 600; font-size: 1rem; color: var(--color-primary);">Arrastre aquí sus documentos o haga clic para examinar</p>
                <p style="margin: 5px 0 0; font-size: 0.8rem; color: var(--color-text-light);">Máximo 10 archivos.</p>
                <input type="file" name="archivos[]" id="archivo" multiple style="display: none;" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
            </div>

            <div id="file-list" style="margin-top: 15px;"></div>
        </div>

        <div class="buttons-row-action" style="display: flex; gap: 15px; margin-top: 30px; border-top: 1px solid var(--color-border); padding-top: 20px;">
            <button type="button" class="btn-secondary" onclick="confirmarVolver()" style="margin-right: auto; padding: 11px 20px; font-weight: 500; font-size: 0.95rem; border-radius: var(--border-radius); border: 1px solid var(--color-border); cursor: pointer;">Volver</button>
            <button type="reset" class="btn-secondary" onclick="clearFile()" style="padding: 11px 20px; font-weight: 500; font-size: 0.95rem; border-radius: var(--border-radius); border: 1px solid var(--color-border); cursor: pointer;">Limpiar Formulario</button>
            <button type="button" class="btn-primary" onclick="confirmarGuardar()" style="background-color: var(--color-secondary); color: var(--color-white); border: none; padding: 13px 24px; border-radius: var(--border-radius); font-weight: 600; font-size: 1rem; cursor: pointer;">Guardar</button>
        </div>
    </form>
@endsection

@stack('styles')
<style>
    .form-grid-columns-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .file-selected-badge { background-color: #f8fafc; border: 1px solid var(--color-border); padding: 10px 15px; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
    .file-selected-badge button { background: none; border: none; color: #ef3340; font-size: 1.2rem; cursor: pointer; line-height: 1; }
</style>

@push('scripts')
<script>
    function confirmarVolver() {
        if (confirm('¿Está seguro de que desea volver? Se perderán los datos no guardados.')) {
            window.location.href = '{{ route("home") }}';
        }
    }

    function confirmarGuardar(e) {
        console.log(e)
        const form = document.querySelector('#actividadForm');
        if (form.checkValidity()) {

            if (confirm('¿Está seguro de que desea registrar y guardar esta actividad?')) {
                console.log(form);
                form.submit();
            }
        } else {
            form.reportValidity();
        }
    }

    function clearFile() {
        selectedFiles = [];
        updateFileInput();
        renderFileList();
    }

    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('archivo');
    const fileList = document.getElementById('file-list');
    let selectedFiles = [];

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
        }, false);
    });

    dropzone.addEventListener('drop', (e) => {
        const files = Array.from(e.dataTransfer.files);
        addFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        addFiles(files);
    });

    function addFiles(files) {
        if ((selectedFiles.length + files.length) > 10) {
            alert('Máximo 10 archivos permitidos');
            return;
        }

        const allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
        const maxSize = 5 * 1024 * 1024;

        files.forEach(file => {
            const extension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(extension)) {
                alert(`Archivo no permitido: ${file.name}`);
                return;
            }
            if (file.size > maxSize) {
                alert(`Archivo excede 5MB: ${file.name}`);
                return;
            }
            selectedFiles.push(file);
        });

        updateFileInput();
        renderFileList();
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    function renderFileList() {
        fileList.innerHTML = '';
        if (selectedFiles.length === 0) return;

        selectedFiles.forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'file-selected-badge';
            item.style.marginBottom = '10px';
            item.innerHTML = `
                <span>Archivo: <strong>${file.name}</strong></span>
                <button type="button" onclick="removeFile(${index})">×</button>
            `;
            fileList.appendChild(item);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFileInput();
        renderFileList();
    }
</script>
@endpush