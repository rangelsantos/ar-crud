<?php 
include "layout/header.html";
include "menu.php";
include "session.php";
?>

<h1>Produtos</h1>
<?php echo '<h2>Bom dia ' . $_SESSION['email'] . ' Bem Vindo ao Sistema.</h2>'; ?>
<table id="tabela" onload="pullProdutos()">

</table>
<script>
    function pullProdutos() {
        document.getElementsById("tabela").innerHTML = "";
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                var table = "<tr><th>Nome</th><th>Descrição</th><th>Codigo</th><th>Fabricante</th><th>Validade</th></tr>";
                var newLine = "";
                for (var i = response.length - 1; i >= 0; i--) {
                    newLine += "<tr><td hidden=\"true\"><p>" + response[i].id + "</p></td><td ondblclick=\"includeEvents(this)\"><p>" + response[i].nome + "</p></td><td ondblclick=\"includeEvents(this)\"><p>" + response[i].descricao + "</p></td><td ondblclick=\"includeEvents(this)\"><p>" + response[i].codigo + "</p></td><td ondblclick=\"includeEvents(this)\"><p>" +
                        response[i].fabricante + "</p></td><td ondblclick=\"includeEvents(this)\"><p>" +
                        response[i].validade + "</p></td><td ondblclick=\"includeEvents(this)\"></tr>"
                }
                table += newLine;
                document.getElementById("tabela").innerHTML = table;
            }
        };
        xhttp.open("GET", "banco/operations.php?q=consulta", true);
        xhttp.send();
    }

    function includeEvents(elemento) { //tratamento do clique duplo nos elementos para edição dos dados
        console.log(elemento)
        elemento.children[0].setAttribute("contenteditable", "true");
        elemento.children[0].setAttribute("onblur", "salva(this)");
    }

    function salva(elemento) { // cria método ajax para fazer o update no banco de dados
        elemento.setAttribute("contenteditable", "false");
        //console.log(elemento.parentElement.parentElement);
        //Recupera e envia todos os dados da linha
        var line = elemento.parentElement.parentElement;
        var id = line.children[0].children[0].innerHTML;
        var nome = line.children[1].children[0].innerHTML;
        var descricao = line.children[2].children[0].innerHTML;
        var codigo = line.children[3].children[0].innerHTML;
        var fabricante = line.children[4].children[0].innerHTML;
        var validade = line.children[5].children[0].innerHTML;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.alert("" + this.responseText);
            }
        }
        xhttp.open("GET", "banco/operations.php?q=atualizar&id=" + id + "&nome=" + nome + "&descricao=" + descricao + "&codigo=" + codigo + "&fabricante=" + fabricante + "&validade=" + validade, true);
        xhttp.send();
    }

    //Deleta o registro no banco de dados
    function deletar(elemento) {
        var xhttp = new XMLHttpRequest();
        var line = elemento.parentElement.parentElement;
        var id = line.children[0].children[0].innerHTML; // somente é necessário a recuperação do ID.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tabela").innerHTML = "";
                window.alert("" + this.responseText);
                pullProdutos();
            }
        }
        xhttp.open("GET", "banco/operations.php?q=delete&id=" + id, true);
        xhttp.send();
    }
</script>

<?php include "layout/footer.html" ?>