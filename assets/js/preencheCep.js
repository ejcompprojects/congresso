function limpa_formulário_cep() {

            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
        }

        function meu_callback(conteudo) {

            if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            var divErroCep =  document.getElementById('erroCep');
            divErroCep.hidden = false;
            divErroCep.className = 'alert alert-danger';
            divErroCep.innerHTML = "CEP não encontrado.";
        }
        $(function () {
            $('#modalCep').modal('hide');
        });
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Div com erro
            var divErroCep =  document.getElementById('erroCep');

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                $(function(){
                    $(function () {
                        $('#modalCep').modal("show");
                    });
                });
                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //show div
                document.getElementById('div_escondida').hidden = false;

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

                divErroCep.hidden = true;
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                divErroCep.hidden = false;
                divErroCep.className = 'alert alert-danger';
                divErroCep.innerHTML = "Formato de CEP inválido.";
                
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }