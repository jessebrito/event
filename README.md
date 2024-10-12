# event
Booking to events and guests

Histórias de Usuário (User Stories)
Aqui descrevemos as funcionalidades do sistema do ponto de vista do usuário.
Documentação Técnica
Detalhes sobre a arquitetura, banco de dados, tecnologias e como cada parte do sistema foi implementada.
1. Histórias de Usuário (User Stories)
História 1: Cadastro de Usuário
Como um visitante do site,
Eu quero me cadastrar no sistema,
Para que eu possa reservar uma data para utilizar os serviços da ONG.
Critérios de Aceitação:

O formulário de cadastro deve solicitar nome, e-mail e senha.
A senha deve ser armazenada de forma criptografada no banco de dados.
Após o cadastro, o usuário será redirecionado para a página de login.
História 2: Login de Usuário
Como um usuário registrado,
Eu quero fazer login no sistema,
Para que eu possa acessar minhas reservas e fazer novas reservas.
Critérios de Aceitação:

O login deve solicitar e-mail e senha.
A senha deve ser verificada corretamente usando password_verify().
Após o login, o usuário será redirecionado para a página de reservas ou para onde estava anteriormente.
História 3: Reservar uma Data
Como um usuário logado,
Eu quero escolher uma data disponível no calendário,
Para que eu possa reservar um dia para utilizar os serviços da ONG.
Critérios de Aceitação:

O sistema deve exibir um calendário com as datas já reservadas em vermelho.
O usuário deve poder selecionar uma data disponível.
Ao selecionar a data, o sistema deve salvar a data na sessão e redirecionar para o processo de pagamento (ou login, se necessário).
História 4: Fluxo de Pagamento
Como um usuário que fez uma reserva,
Eu quero realizar o pagamento da minha reserva,
Para que minha reserva seja confirmada e eu possa usar os serviços da ONG.
Critérios de Aceitação:

O usuário deve ser redirecionado para uma página de pagamento.
Após a confirmação do pagamento, a reserva deve ser marcada como confirmada.
A reserva só pode ser marcada como confirmada após o pagamento.
História 5: Listar e Gerenciar Reservas
Como um usuário logado,
Eu quero ver a lista das minhas reservas,
Para que eu possa acompanhar o status delas e gerenciar meus compromissos.
Critérios de Aceitação:

O usuário deve ver a lista de reservas que fez, com a data e o status (pendente, confirmada).
O sistema deve indicar se o pagamento foi feito ou não.
História 6: Funcionalidades de Administrador
Como um administrador,
Eu quero gerenciar as reservas e usuários,
Para que eu possa garantir que o sistema funcione corretamente.
Critérios de Aceitação:

O administrador pode ver todas as reservas (pendentes e confirmadas) em um painel.
O administrador pode confirmar ou cancelar reservas manualmente.
O administrador pode exportar a lista de usuários e suas reservas em um arquivo CSV.
O administrador pode bloquear datas diretamente no calendário para eventos da ONG.
História 7: Compartilhamento de Convite via WhatsApp
Como um usuário que fez uma reserva,
Eu quero criar uma lista de convidados,
Para que eu possa enviar convites com a data e detalhes da reserva via WhatsApp.
Critérios de Aceitação:

O usuário pode adicionar convidados (nome, e-mail, telefone) e indicar se o convidado vai acompanhado.
Um link de compartilhamento é gerado e pode ser enviado via WhatsApp para os convidados.
Apenas o organizador da reserva pode editar ou excluir a lista de convidados.
2. Documentação Técnica
Visão Geral do Sistema
O sistema de reservas da ONG é uma aplicação web que permite aos usuários se cadastrarem, fazer login e reservar datas para utilizar os serviços da ONG. O sistema também possui um painel administrativo que permite ao administrador gerenciar reservas, bloquear datas e exportar dados.

Arquitetura do Sistema
O sistema segue uma arquitetura MVC (Model-View-Controller) simplificada:

Model (Modelo):

Interage com o banco de dados MySQL, armazenando e recuperando informações relacionadas a usuários, reservas e pagamentos.
View (Visão):

Responsável pela apresentação e interação do usuário, usando HTML, Bootstrap e FullCalendar.
Controller (Controlador):

Processa as requisições, valida os dados e interage com o banco de dados para executar as ações necessárias.
Tecnologias Utilizadas
PHP: Linguagem de programação para o back-end.
MySQL: Banco de dados relacional para armazenar dados de usuários, reservas e pagamentos.
Bootstrap: Framework CSS para estilização e responsividade.
FullCalendar.js: Biblioteca JavaScript para exibir o calendário interativo.
JavaScript: Usado para interações no front-end.
Sessions (PHP): Para armazenar informações temporárias do usuário, como a data de reserva antes do login.
HTML/CSS: Para estruturação e estilização das páginas.
Banco de Dados
O banco de dados MySQL contém as seguintes tabelas principais:

Tabela users
Coluna	Tipo	Descrição
id	INT	Chave primária, identificador único do usuário.
name	VARCHAR(255)	Nome completo do usuário.
email	VARCHAR(255)	E-mail do usuário, usado para login.
password	VARCHAR(255)	Senha criptografada usando password_hash().
created_at	TIMESTAMP	Data de criação da conta.
is_admin	TINYINT	Indica se o usuário é administrador (1) ou não (0).
Tabela reservations
Coluna	Tipo	Descrição
id	INT	Chave primária, identificador único da reserva.
user_id	INT	Chave estrangeira para users.
reserved_date	DATE	Data reservada pelo usuário.
status	ENUM	Status da reserva: pendente, confirmada, rejeitada.
created_at	TIMESTAMP	Data em que a reserva foi criada.
Tabela guest_list (Opcional para a funcionalidade de convidados)
Coluna	Tipo	Descrição
id	INT	Chave primária, identificador único da lista de convidados.
reservation_id	INT	Chave estrangeira para reservations.
name	VARCHAR(255)	Nome do convidado.
email	VARCHAR(255)	E-mail do convidado.
phone	VARCHAR(20)	Telefone do convidado.
is_accompanied	TINYINT	Indica se o convidado vai acompanhado (1) ou não (0).
Fluxo de Funcionalidade
Cadastro/Login: O usuário se cadastra e faz login, suas informações são armazenadas no banco de dados.
Reserva: O usuário seleciona uma data no calendário e a reserva é criada com o status pendente.
Pagamento: Após o pagamento, o status da reserva é alterado para confirmada.
Administração: O administrador pode gerenciar as reservas e bloquear datas diretamente pelo painel.
Segurança
As senhas dos usuários são criptografadas utilizando o algoritmo password_hash() no PHP.
As sessões são usadas para autenticar usuários e garantir que somente usuários logados possam acessar certas áreas.
Validações de entrada de dados são feitas tanto no lado do cliente (JavaScript) quanto no lado do servidor (PHP).
