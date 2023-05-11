<?php
//foreach($items as $item){
    /*
    echo $item['id'] . '<br>';
    echo $item['nombre'] . '<br>';
    echo $item['codigo'] . '<br>';
    echo $item['precio'] . '<br>'; 
    

    echo $item->id .'<br>';
    echo $item->nombre .'<br>';
    echo $item->codigo .'<br>';
    echo $item->precio .'<br>';
    */
//}

//$data2 = json_encode($items);
//echo $data2;

//var_dump($items[0]['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
    
        #searchWrapper::after {
        content: '🔍';
        position: absolute;
        top: 7px;
        right: 15px;
    }
    </style>

    <!-- jQuery -->
    <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>

    <script>

    let db = $.ajax({

    url: "<?php echo base_url()?>tests/testProductos",
    type: 'POST',
    //data: "<?//php $data; ?>",
    async: true,
    dataType: 'json',
    error: function(data){
            alert('Los datos no llegaron');
    },
    success: function(data){

        let searchBar = document.querySelector('#searchBar');
        let items = document.querySelector('#items');
        let canasta = document.querySelector('#canasta');
        let total = document.querySelector('#total');
        let botonVaciar = document.querySelector('#botonVaciar');
        let $canasta = [];
        let $total = 0;

        let totalHidden = document.querySelector('#totalHidden');
        let precio_producto = document.querySelector('#precio_producto');
        let precio_producto_2 = document.getElementById('precio_producto_2');
        let unidades_2 = document.getElementById('unidades_2');
        let producto_id_2 = document.getElementById('producto_id_2');
        //let $total2 = 0;

        function renderItems(){

            console.log('renderItems Up')

            for(let item of data){  
                //console.log(item['id']+' '+item['nombre']+' '+item['precio']);

                //Card structure
                let miNodo = document.createElement('div');
                miNodo.classList.add('card', 'col-md-4');
                //miNodo.setAttribute('id', 'example1');

                //Card body 
                let miNodoCardBody = document.createElement('div');
                miNodoCardBody.classList.add('card-body');
                

                //Image
                let miNodoImagen = document.createElement('img');
                miNodoImagen.classList.add('img-fluid');
                miNodoImagen.style.setProperty('width', '45px');
                miNodoImagen.setAttribute('src', 'public/uploads/imagenes_productos/'+ item['imagen']);

                //Brand

                //Title
                miNodoTitle = document.createElement('h6');
                miNodoTitle.classList.add('card-title');
                miNodoTitle.textContent = item['nombre'];

                //Price
                miNodoPrecio = document.createElement('p');
                miNodoPrecio.classList.add('card-text');
                miNodoPrecio.textContent = '$' + item['precio'];

                //Stock

                //Button (empty)
                miNodoBoton = document.createElement('button');
                miNodoBoton.classList.add('btn', 'btn-info');
                miNodoBoton.style.setProperty('margin-left', '20px');
                miNodoBoton.style.setProperty('height', '30px');
                miNodoBoton.style.setProperty('padding-bottom', '28px');
                miNodoBoton.textContent = '+';
                
                miNodoBoton.setAttribute('marcador', item['id']);
                miNodoBoton.addEventListener('click', addCanasta);

                miNodoCardBody.appendChild(miNodoImagen);
                miNodoCardBody.appendChild(miNodoBoton);
                miNodoCardBody.appendChild(miNodoTitle);
                miNodoCardBody.appendChild(miNodoPrecio);
                

                miNodo.appendChild(miNodoCardBody);
                items.appendChild(miNodo);
            }
            /*
            searchBar.addEventListener('keyup', (e) => {
            let stringInput = e.target.value.toLowerCase();

            let finder = data.filter((catchStrings) => {

                return catchStrings.nombre.toLowerCase().includes(stringInput);
            });

            console.log(finder);

             ///return items.finder;
        });*/
        }

        function addCanasta(){

            //add canasta
            $canasta.push(this.getAttribute('marcador'));
            console.log($canasta)

            //calcule total cost
            calcularTotal(); 
            //Hasta este punto el carrito no puedo calcular por item sino por el ultimo de todos los items

            //renderize canasta
            renderizarCanasta();
        }

        function renderizarCanasta(){

            // Vaciamos todo el html
            canasta.textContent = '';

            // Quitamos los duplicados (Investigar por que declaramos este set en un array (arrastre))
            canastaSinDuplicados = [...new Set($canasta)]; 

            // Generamos los Nodos a partir de canasta
            canastaSinDuplicados.forEach(function(item, index) { //index segundo param, no se uso.
                
            // Obtenemos el item que necesitamos de la variable base de datos
                positionOfProducts = data.filter(function(productOfData){
                    return productOfData['id'] == item; 
                });

            // Cuenta el número de veces que se repite el producto
                    let productUnities = $canasta.reduce(function($total, productId){
                        return productId === item ? $total += 1 : $total;

                    }, 0);

            // Creamos el nodo del item del carrito
                let miNodo = document.createElement('li');
                miNodo.classList.add('list-group-item', 'text-left', 'mx-2');
                miNodo.textContent = `${productUnities} x ${positionOfProducts[0]['nombre']} - $${positionOfProducts[0]['precio']}`;

                let miInputHidden = document.createElement('input');
                miInputHidden.setAttribute('value', productUnities);
                miInputHidden.setAttribute('name', 'unidades');

                let miSegundoInputHidden = document.createElement('input');
                miSegundoInputHidden.setAttribute('value', positionOfProducts[0]['id']);
                miSegundoInputHidden.setAttribute('name', 'producto_id');

                let miTercerInputHidden = document.createElement('input');
                miTercerInputHidden.setAttribute('value', positionOfProducts[0]['precio']);
                miTercerInputHidden.setAttribute('name', 'precio_producto');
                //miTercerInputHidden = precio_producto;

                canasta.appendChild(miNodo);
                canasta.appendChild(miInputHidden);
                canasta.appendChild(miSegundoInputHidden);
                canasta.appendChild(miTercerInputHidden);

                unidades_dup = miInputHidden.getAttribute('value');
                unidades_2.setAttribute('value', unidades_dup);

                 producto_id_dup = miSegundoInputHidden.getAttribute('value');
                 producto_id_2.setAttribute('value', producto_id_dup);

                precio_producto_dup = miTercerInputHidden.getAttribute('value');
                precio_producto_2.setAttribute('value', precio_producto_dup);

                console.log('loading data...' + productUnities + ' ' + positionOfProducts[0]['precio'])
            });
        }

        function calcularTotal(){

                // Limpiamos precio anterior
                $total = 0;
                //$total2 = 0;

                // Recorremos el array de la canasta
                for(let product of $canasta){

                // De cada elemento obtenemos su precio
                    let positionOfProducts = data.filter(function(productOfData){
                        return productOfData['id'] == product;
                    });
                    //console.log(positionOfProducts[0]['precio']) //Solo no esta arrojando el ultimo objeto

                    //En mi caso tengo que parsear los precios, ya que vienen de mysql. parseFloat()
                    $total = $total + parseFloat(positionOfProducts[0]['precio']);
                    //$total2 = $total2 + parseFloat(positionOfProducts[0]['precio']);
                }

                // Formateamos el total para que solo tenga dos decimales
                //let totalDosDecimales = total.toFixed(2); en mi caso no requeriremos de esta variable

                // Renderizamos el precio en el HTML
                total.textContent = $total;
                totalHidden.setAttribute('value', $total)
                //console.log(totalHidden.setAttribute('value', $total2));

        }

        function vaciarCanasta(){
            console.log('vaciado')

            $canasta = [];
            calcularTotal();
            renderizarCanasta();
        }

        // Vaciar canasta completa
        botonVaciar.addEventListener('click', vaciarCanasta);

        
        renderItems();

    }

});





</script>
</head>
<body>
    <div class="container">
    <h2>Carga de productos</h2>
        <div class="row">
            <!-- Elementos generados a partir del JSON -->
            <main id="items" class="col-sm-8 row">
            <!-- 
            <input 
                    type="text" 
                    class="form-control mb-3" 
                    name="searchBar" 
                    id="searchBar" 
                    placeholder="Busca un producto"
                    />
            -->
            </main>
            <!-- Canasta -->
            <aside class="col-sm-4">
                <h2>Pedido</h2>
                <!-- Elementos del canasta -->
                <ul id="canasta" class="list-group"></ul>
                <hr>
                <!-- Precio total -->
                <?php echo form_open(base_url('tests/index')) ?>

                <p class="text-right">Total: <span id="total"></span>&dollar;</p>
                <button id="botonVaciar" class="btn btn-danger">Vaciar</button>
                
                <input type="submit" name="submit" id="" class="btn btn-primary" value="Crear"/>
                <input type="text" id="totalHidden" name="totalHidden">
                <input type="text" id="precio_producto_2" name="precio_producto_2" value="">
                <input type="text" id="unidades_2" name="unidades_2" value="">
                <input type="text" id="producto_id_2" name="producto_id_2">
                <?php echo form_close() ?>
            </aside>
        </div>
    </div>
</body>
</html>


