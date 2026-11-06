STATUS CODE:

200 -> Ok
201 -> Criar recurso com POST
204 -> Excluido com sucesso/não retorna json
400 -> JSON inválido / no controller -> nao chegou no service ainda
401 -> Sem autorização/não autênticado
403 -> Autenticado mas sem permissão
404 -> Recurso não existe
409 -> Conflito de regra. ex: email ja cadastrado
422 -> JSON válido, mas dados falham na validação. ex: nota maior que 10, email nao existe
500 -> erro inesperado do servidor