<!DOCTYPE html>
<html>

<?php include 'inc/head.php'; ?>

<head>
    <style>
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include './inc/navigation.php'; ?>

    <div id="hotelpics" class="carousel slide mt-3" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#hotelpics" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#hotelpics" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#hotelpics" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="res/img/room.webp" alt="room" class="d-block">
            </div>
            <div class="carousel-item">
                <img src="res/img/hotel5.jpg" alt="Pool" class="d-block">
            </div>
            <div class="carousel-item">
                <img src="res/img/pool_out.jpg" alt="Outside Pool" class="d-block">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#hotelpics" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelpics" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</body>

</html>