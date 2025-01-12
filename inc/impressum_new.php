<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .photo {
            margin: 10px;
        }

        img {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }

        .impressum-content,
        .impressum-details {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>

<body>

    <?php include 'navigation.php'; ?>
    <div class="impressum-photo">
        <div class="container">
            <div class="card mx-2" style="max-width: 250px;">
                <img src="..\res\img\impressum_vili.jpg" alt="Team member Velichka Georgieva" class="card-img-top mx-auto d-block">
                <div class="card-body">
                    <h4 class="card-title">Velichka Georgieva</h4>
                    <p class="card-text">Team member</p>
                    <a href="mailto:if24b265@technikum-wien.at" class="btn btn-primary">Send me a mail</a>
                </div>
            </div>
            <div class="card mx-2" style="max-width: 250px;">
                <img src="..\res\img\impressum_fpm.webp" alt="Team member Filipe Portela Millinger" class="card-img-top mx-auto d-block">
                <div class="card-body">
                    <h4 class="card-title">Filipe Portela Millinger</h4>
                    <p class="card-text">Team member</p>
                    <a href="mailto:if23b116@technikum-wien.at" class="btn btn-primary">Send me a mail</a>
                </div>
            </div>
        </div>
    </div>

    <div class="impressum-content text-center">
    <h1>Impressum</h1>
    <p>Hotel Wellness GmbH <br>
        Teststraße 12, 1234 Muster</p>
    <h2>Contact Support</h2>
    <p>If you need more help, please reach out to us:</p>
    <p>Name: Velichka Georgieva</p>
    <p>Email: <a href="mailto:if24b265@technikum-wien.at">if24b265@technikum-wien.at</a></p>
    <p>Phone: +43 123 456789</p> 
    <p>Name: Filipe Portela Millinger</p>
    <p>Email: <a href="mailto:if23b112@technikum-wien.at">if23b112@technikum-wien.at</a></p>
    <p>Phone: +43 987 654321</p> 
    <p>Our support team is available 24/7 to assist you.</p>
</div>


    <div class="impressum-details">
        <h2>Legal Notice</h2>
        <p>UID-Nummer UID-Nr: ATU12345678 <br>
            Firmenbuchnummer FN: 1234567 <br>
            Firmenbuchgericht: Musterstadt <br>
            Firmensitz: XXXX Musterdorf<br>
            Musterstraße 12 | Austria <br>
            Mitglied der WKÖ, ÖHV</p>
    </div>

  

    <footer>
        <p class="text-center" style="color: red;">Verbraucher haben die Möglichkeit,
            Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten:
            <a href="http://ec.europa.eu/odr">Online-Streitbeilegung</a> <br>
            Sie können allfällige Beschwerde auch an
            die oben angegebene E-Mail-Adresse richten.
        </p>
    </footer>

</body>

</html>
