<!DOCTYPE html>
<html>
<head>
    <style>
    /* Estilização do modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

/* Estilização do botão fechar */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


    </style>
</head>
<body>
    

    <button onclick="openContaModal('Teste de Modal')">Abrir Modal</button>

    <div id="myModalConta" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalConta()">&times;</span>
            <h2>Status do Cadastro</h2>
            <p id="contaMessage"></p>
        </div>
    </div>

    <script>
        function openContaModal(message) {
            var modal = document.getElementById("myModalConta");
            modal.style.display = "block";
            document.getElementById("contaMessage").innerText = message;
        }

        function closeModalConta() {
            var modal = document.getElementById("myModalConta");
            modal.style.display = "none";
        }
    </script>

</body>
</html>
