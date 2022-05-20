<?php 
    require ('reg_auth/index.php');
?>

<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">

    <title>CinemaStore</title>

    <script src="jquery/jquery.js"></script>
    
    <link href="style.css" rel="stylesheet">
    <link href="FA/css/all.css" rel="stylesheet">
    <script src="FA/js/all.Js"></script>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">CinemaStore by KorolevskiyK</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                               <!-- <a class="nav-link active" aria-current="page" href="#">Товары</a> -->
                            </li>
                        </ul>                    
                        
                        <div class="filters">
                            <div class="filters_checkboxes">
                                <span>
                                    <!-- Сортировка по цене -->
                                    <input type='checkbox' @change="sortPrice" v-model="sortedByPrice" id="sortedByPrice">
                                    <label for='sortedByPrice'> Отсортировать по цене</label>
                                </span>
                                <span>
                                    <!-- Сортировка по названию -->
                                    <input type='checkbox' @change="sortName" v-model="sortedByName" id="sortedByName">
                                    <label for='sortedByName'> Отсортировать по имени</label>
                                </span>
                            </div>
                            
                            <div class="filters_prices">
                            <label>Минимальная цена</label>
                                <div class="filters_minprice">
                                    <input v-model.number="minPrice" type="number">
                                </div>
                            </div>                        
                            
                            <div class="filters_prices">
                            <label>Максимальная цена</label>
                                <div class="filters_maxprice">

                                    <input v-model.number="maxPrice" type="number">
                                </div>
                            </div>
                        </div>

                        <form class="d-flex">
                            <input type="checkbox" id="side-checkbox" />
                            <div class="side-panel">
                                <label class="side-button-2" for="side-checkbox">+</label>
                                <div class="side-title">Корзина:</div>     
                                <span>Итоговая сумма: {{sum}}</span>
                                <p></p>
                                <div v-for="product in bag">
                                <div class="d-flex"><div>{{product.name}}: </div>
                                <div>
                                    <label class="side-button-3" v-on:Click="deleteFromBag(product.id)"> &ensp; - </label> {{product.quantity}} <label class="side-button-3" v-on:Click="addToBag(product.id)"> + </label>                                    
                                    <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="side-button-1-wr">
                                <label class="side-button-1" for="side-checkbox">
                                    <div class="side-b side-open"><span title="Корзина"><i class="fa fa-shopping-basket"></i></span></div>
                                </label>
                            </div>                            
                        </form>                        
                    </div>
                </div>
            </nav>
        </header>
        <div class="main">            
            <div class="card-list d-flex justify-content-around">
                <div v-for="product in filteredProducts" class="card m-3" style="width: 19rem;">
                    <img :src="'image/' + product.img + '.jpg'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{product.name}}</h5>
                        <p class="card-text">{{product.description}}</p>
                        <span>{{product.price}} <i class="fa fa-ruble-sign"></i></span>
                    </div>
                    <div class="text-center card-footer bg-transparent border-secondary">
                        <a class="btn btn-primary" v-on:Click="addToBag(product.id)">В корзину </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>