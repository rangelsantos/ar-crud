<?php
include "menu.php";
include "session.php";
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>AR - Rangel Santos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body onload="pullProdutos()">
    <div class="container">
        <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-lg-10">
                <h2>Produtos</h2>
                <table class="table table-bordered table-hover" id="tabela">
                </table>

                <script>
                    function pullProdutos() {
                        document.getElementById("tabela").innerHTML = "";
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                console.log(response);
                                var table = "<thead><tr><th>Nome</th><th>Descrição</th><th>Codigo</th><th>Fabricante</th><th>Validade</th><th>Ações</th></tr></thead>";
                                var newLine = "";
                                for (var i = response.length - 1; i >= 0; i--) {
                                    newLine += "<tbody><tr><td hidden=\"true\">" + response[i].id + "</td><td style=\"vertical-align: middle;\">" + response[i].nome + "</td><td style=\"vertical-align: middle;\">" + response[i].descricao + "</td><td style=\"vertical-align: middle;\">" + response[i].codigo + "</td><td style=\"vertical-align: middle;\">" +
                                        response[i].fabricante + "</td><td style=\"vertical-align: middle;\">" + response[i].validade + "</td><td style=\"vertical-align: middle;\"><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-primary btn-sm\" onclick=\"includeEvents(this)\">Editar</button><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-danger btn-sm\" onclick=\"deletar(this)\">Deletar</button></td></tr></tbody>"
                                }
                                table += newLine;
                                document.getElementById("tabela").innerHTML = table;
                            }
                        };
                        xhttp.open("POST", "banco/operations.php?q=consulta", true);
                        xhttp.send();
                    }

                    function includeEvents(elemento) {
                        elemento.parentElement.parentElement.setAttribute("contenteditable", "true");
                        elemento.parentElement.parentElement.children[6].setAttribute("contenteditable", "false");
                        elemento.parentElement.parentElement.children[6].innerHTML = "<td style=\"vertical-align: middle;\"><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-success btn-sm\" onclick=\"salva(this)\">Salvar</button><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-danger btn-sm\" onclick=\"deletar(this)\">Deletar</button></td>";                     
                    }

                    function salva(elemento) {
                        elemento.parentElement.parentElement.setAttribute("contenteditable", "false");                        
                        var line = elemento.parentElement.parentElement;
                        var id = line.children[0].innerHTML;
                        var nome = line.children[1].innerHTML;
                        var descricao = line.children[2].innerHTML;
                        var codigo = line.children[3].innerHTML;
                        var fabricante = line.children[4].innerHTML;
                        var validade = line.children[5].innerHTML;
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                window.alert("" + this.responseText);
                            }
                        }
                        xhttp.open("POST", "banco/operations.php?q=atualizar&id=" + id + "&nome=" + nome + "&descricao=" + descricao + "&codigo=" + codigo + "&fabricante=" + fabricante + "&validade=" + validade, true);
                        xhttp.send();
                        elemento.parentElement.parentElement.children[6].innerHTML = "<td style=\"vertical-align: middle;\"><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-primary btn-sm\" onclick=\"includeEvents(this)\">Editar</button><button style=\"margin-right: 10px; margin-left: 10px;\" class=\"btn btn-danger btn-sm\" onclick=\"deletar(this)\">Deletar</button></td>";
                    }

                    function deletar(elemento) {
                        var xhttp = new XMLHttpRequest();
                        var line = elemento.parentElement.parentElement;
                        var id = line.children[0].innerHTML;
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("tabela").innerHTML = "";
                                window.alert("" + this.responseText);
                                pullProdutos();
                            }
                        }
                        xhttp.open("POST", "banco/operations.php?q=remover&id=" + id, true);
                        xhttp.send();
                    }
                </script>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>
    <?php include "layout/footer.html" ?>