<?php
// repassei a matricula que ele tentou logar mas quero guardar ela para exibir no erro
$matricula_error = $_GET['matricula_error'];

if($matricula_error == ''){
    header('Location: ../login.html');
    exit();
}

$referer = $_SERVER['HTTP_REFERER'];

if($referer == ''){
    $matricula_error = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/scss/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/movie.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>IFilmes Web Site</title>
</head>

<body>
    <style>
        :root {
            --scale: 50px;
            /* Ajuste esta variável para alterar a escala do círculo de progresso */
        }

        .progress-circle {
            width: var(--scale);
            height: var(--scale);
            border-radius: 50%;
            background: conic-gradient(#0d6efd 0%, #e9ecef 0%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #0d6efd;
            position: relative;
        }

        .progress-circle::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .progress-text {
            position: relative;
            z-index: 1;
            font-size: 1rem;
        }
    </style>
    <div class="login_box">
        <div class="card border border-4" style="min-width: 30rem;max-width: auto;  height: 20rem;">
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div id="progressCircle" class="progress-circle">
                    <span id="progressText" class="progress-text">0%</span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <img src="../img/movie.png" class="card-img-top mx-auto p-2 img_login">
            </div>
            <div class="card-body border-top border-3 d-flex-inline">
                <div class="row align-items-center h-100">
                    <div>
                        <h3 class="card-title text-center text-danger">Error<svg xmlns="http://www.w3.org/2000/svg"
                                width="26" height="26" fill="currentColor" class="bi bi-bug-fill m-1"
                                viewBox="0 0 16 16">
                                <path
                                    d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A5 5 0 0 0 3 6h10a5 5 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A5 5 0 0 0 8 1a5 5 0 0 0-2.731.811l-.29-.956z" />
                                <path
                                    d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975" />
                            </svg></h3>
                        <p class="card-text text-center text-warning">Atenção não conseguimos encontrar sua matricula:
                            <?php echo htmlspecialchars($matricula_error) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script-home.js"></script>
    <script src="js/script-login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        // Function to update the progress circle
        function updateProgress(percent) {
            const progressCircle = document.getElementById('progressCircle');
            const progressText = document.getElementById('progressText');
            const angle = percent * 80; // Convert percentage to degrees
            progressCircle.style.background = `conic-gradient(#0d6efd ${angle}deg, #e9ecef ${angle}deg 360deg)`;
            progressText.textContent = `${percent}`;
        }

        // Example usage
        let progress = 0;
        const interval = setInterval(() => {
            progress = (progress + 1) % 6; // Increment progress, reset to 0 after 100%
            updateProgress(progress);
            if (progress == 5){
                window.location.href = "../login.html";
            }
        }, 1000); // Update every 100ms (adjust as needed)
    </script>
</body>

</html>