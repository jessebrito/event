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
            background: url('https://images.unsplash.com/photo-1503428593586-e225b39bddfe') no-repeat center center;
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
        <a class="btn btn-primary btn-lg" href="/reserva/pages/reserve.php" role="button">Agende uma Atividade</a>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-md-4">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1581579186914-4fe1a0d0f17c" class="card-img-top" alt="Educação">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book-open"></i> Educação</h5>
                    <p class="card-text">Oferecemos cursos gratuitos de reforço escolar, alfabetização de adultos e capacitação profissional para jovens.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1580281657521-1ea160fb36c6" class="card-img-top" alt="Saúde">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-heartbeat"></i> Saúde</h5>
                    <p class="card-text">Realizamos campanhas de vacinação, atendimentos médicos comunitários e palestras sobre saúde preventiva.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1515162305281-53c3a01292fd" class="card-img-top" alt="Cultura e Esportes">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-futbol"></i> Cultura e Esportes</h5>
                    <p class="card-text">Promovemos eventos culturais, festivais e atividades esportivas para crianças, jovens e adultos, fortalecendo o senso de comunidade.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- O restante do conteúdo continua igual... -->

<?php
// Inclui o template de rodapé
include 'templates/footer.php';
?>
</body>
</html>
