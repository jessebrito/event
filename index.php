<?php
// Iniciar sessão (se necessário)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclui o template de cabeçalho
include 'templates/header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>ONG Comunidade Solidária</title>
    <style>
        .jumbotron {
            background: url('images/ONG-image-1.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-shadow: 1px 1px 5px #000;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .testimonial {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .testimonial img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Bem-vindo à ONG Comunidade Solidária</h1>
        <p class="lead">Juntos por um futuro melhor para nossa comunidade.</p>
        <hr class="my-4">
        <p>Contribuímos para o desenvolvimento da comunidade local através de programas de educação, saúde e cultura.</p>
        <a class="btn btn-primary btn-lg" href="/evento/pages/reserve.php" role="button">Agende uma Atividade</a>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-md-4">
            <div class="card">
                <img src="images/ONG-image-02.jpg" class="card-img-top" alt="Educação">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book-open"></i> Educação</h5>
                    <p class="card-text">Oferecemos cursos gratuitos de reforço escolar, alfabetização de adultos e capacitação profissional para jovens.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <img src="images/ONG-image-03.jpg" class="card-img-top" alt="Saúde">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-heartbeat"></i> Saúde</h5>
                    <p class="card-text">Realizamos campanhas de vacinação, atendimentos médicos comunitários e palestras sobre saúde preventiva.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="images/ONG-image-04.jpg" class="card-img-top" alt="Cultura e Esportes">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-futbol"></i> Cultura e Esportes</h5>
                    <p class="card-text">Promovemos eventos culturais, festivais e atividades esportivas para crianças, jovens e adultos, fortalecendo o senso de comunidade.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-center">O que Fazemos</h2>
        <p class="text-center">A ONG Comunidade Solidária atua há mais de 10 anos na cidade, promovendo ações que visam o bem-estar e o desenvolvimento da população local. Contamos com uma equipe de voluntários dedicados que trabalham para oferecer suporte em áreas fundamentais como educação, saúde e cultura.</p>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Nossos Programas</h3>
            <ul class="list-group">
                <li class="list-group-item"><i class="fas fa-check-circle"></i> Reforço Escolar para crianças e adolescentes</li>
                <li class="list-group-item"><i class="fas fa-check-circle"></i> Capacitação Profissional para Jovens</li>
                <li class="list-group-item"><i class="fas fa-check-circle"></i> Atendimentos Médicos Comunitários</li>
                <li class="list-group-item"><i class="fas fa-check-circle"></i> Campanhas de Vacinação e Palestras sobre Saúde</li>
                <li class="list-group-item"><i class="fas fa-check-circle"></i> Eventos Esportivos e Culturais</li>
            </ul>
        </div>

        <div class="col-md-6">
            <h3>Como Ajudar</h3>
            <p>Você pode se tornar um voluntário ou fazer uma doação para apoiar nossos programas. Toda ajuda é bem-vinda e faz a diferença na vida de muitas pessoas.</p>
            <a class="btn btn-success btn-lg mb-2" href="#"><i class="fas fa-hands-helping"></i> Seja um Voluntário</a>
            <a class="btn btn-warning btn-lg mb-2" href="#"><i class="fas fa-donate"></i> Faça uma Doação</a>
        </div>
    </div>

    <!-- Seção de Depoimentos -->
    <div class="mt-5">
        <h2 class="text-center">Depoimentos</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="https://via.placeholder.com/80" alt="Depoimento 1">
                    <h5>Maria Silva</h5>
                    <p>"Participar das aulas de reforço mudou minha vida e me ajudou a conseguir uma vaga de emprego."</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="https://via.placeholder.com/80" alt="Depoimento 2">
                    <h5>João Oliveira</h5>
                    <p>"Graças às atividades esportivas da ONG, meus filhos estão mais felizes e saudáveis."</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial text-center">
                    <img src="https://via.placeholder.com/80" alt="Depoimento 3">
                    <h5>Ana Costa</h5>
                    <p>"A equipe de voluntários é incrível! Sempre prontos para ajudar e apoiar a comunidade."</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
// Inclui o template de rodapé
include 'templates/footer.php';
?>

</body>
</html>
