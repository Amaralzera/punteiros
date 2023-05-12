<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivos</title>
    <style>
        .container {
            width: 500px;
            margin: 0 auto;
        }
        #drop-area {
            width: 100%;
            height: 200px;
            border: 2px dashed #ccc;
            text-align: center;
            padding: 40px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload de Arquivos</h2>
        <div id="drop-area">
            Arraste e solte os arquivos aqui ou clique para selecionar.
            <input type="file" id="file-input" multiple>
        </div>
        <div id="file-list"></div>
    </div>

    <script>
        let dropArea = document.getElementById('drop-area');

        dropArea.addEventListener('dragenter', handleDragEnter, false);
        dropArea.addEventListener('dragover', handleDragOver, false);
        dropArea.addEventListener('dragleave', handleDragLeave, false);
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDragEnter(e) {
            e.preventDefault();
            dropArea.style.background = '#e1e1e1';
        }

        function handleDragOver(e) {
            e.preventDefault();
        }

        function handleDragLeave(e) {
            e.preventDefault();
            dropArea.style.background = '#ffffff';
        }

        function handleDrop(e) {
            e.preventDefault();
            dropArea.style.background = '#ffffff';
            let fileList = e.dataTransfer.files;
            handleFiles(fileList);
        }

        let fileInput = document.getElementById('file-input');
        fileInput.addEventListener('change', function() {
            handleFiles(fileInput.files);
        });

        function handleFiles(files) {
            let fileList = document.getElementById('file-list');
            fileList.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let listItem = document.createElement('div');
                listItem.textContent = file.name;
                fileList.appendChild(listItem);
            }
        }
    </script>
</body>
</html>