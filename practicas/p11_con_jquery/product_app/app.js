// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listAllProducts()
    
}

function listAllProducts() {
    $.ajax({
        url: "./backend/product-list.php",
        success: function( result ) {
            let products = JSON.parse(result);
            let tableRows = ''
            products.forEach( product => {
                tableRows +=
                    `
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.nombre}</td>
                        <td>
                            <ul>
                                <li>precio: ${product.precio}'</li>
                                <li>unidades: ${product.unidades}'</li>
                                <li>modelo: ${product.modelo}'</li>
                                <li>marca: ${product.marca}'</li>
                                <li>detalles: ${product.detalles}'</li>
                            </ul>
                        </td>
                        <td>
                            <button class="product-delete btn btn-danger" type="button">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    `
            });
            const productsTableBody = $('#products');
            productsTableBody.html(tableRows);
        }
    });
}

/******** Search product on every keyup event **********/
const searchInput = $('#search')
searchInput.keyup( () => { //anonymus function
    const currentValue = searchInput.val()
    $.ajax({
        url: "./backend/product-search.php",
        data:{
            search: currentValue
        },
        success: ( result ) => {
            const products = JSON.parse(result);
            let tableRows = ''
            let template_bar = ''
            products.forEach( product => {
                tableRows +=
                    `
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.nombre}</td>
                        <td>
                            <ul>
                                <li>precio: ${product.precio}'</li>
                                <li>precio: ${product.unidades}'</li>
                                <li>precio: ${product.modelo}'</li>
                                <li>precio: ${product.marca}'</li>
                                <li>precio: ${product.detalles}'</li>
                            </ul>
                        </td>
                        <td>
                            <button class="product-delete btn btn-danger" type="button">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    `
                template_bar += ` <li>${product.nombre}</il>`;
            });
            const productsTableBody = $('#products');
            productsTableBody.html(tableRows)
            $('#product-result').addClass('card my-4 d-block')
            $('#container').html(template_bar)
        }
    })
});

/********* Add product *********/
const addButton = $('.btn-primary');
addButton.click(() => {
    const nameInputValue = $('#name').val();
    const descriptionValue = $('#description').val();
    const parsedDescrptionValue = JSON.parse(descriptionValue);
    const productData = 
    {
        nombre: nameInputValue,
        ...parsedDescrptionValue
    }
    const validations = validateProductData(productData);
    if(validations.length > 0){
        let validationsTemplate = '';
        validations.forEach(validation => {
            validationsTemplate +=  `<li>${validation}</li>`
        })
        $('#product-result').addClass('card my-4 d-block')
        $('#container').html(validationsTemplate)
    }
    else{
        $.post({
            url: "./backend/product-add.php",
            data:  JSON.stringify(productData),
            success: ( result ) => {
                const response = JSON.parse(result);
                $('#product-result').addClass('card my-4 d-block')
                if(response.status == "success"){
                    $('#container').html('<li>Producto agregado exitosamente!</li>')
                    listAllProducts();
                }
                else{
                    console.log("es un error")
                    $('#container').html(
                        `
                        <li>Status: ${response.status}</li>
                        <li>Message: ${response.message}</li>
                        `
                    )
                }
            },
            error: (err) => {
                console.log(err.message)
            }
        })
    }
})

function validateProductData(data)
{
    let response = [];
    if (data.nombre == '') response = ['El nombre es obligatorio']
    if (data.precio <= 0) response = [...response, 'El precio debe ser mayor a 0']
    if (data.unidades <= 0) response = [...response, 'Las unidades deben ser mayores a 0']
    if (data.modelo <= '') response = [...response, 'El modelo es obligatorio']
    if (data.marca <= '') response = [...response, 'La marca es obligatoria']
    return response;
}

/********* Delete product *********/
const deleteButton = $('.product-delete btn btn-danger');
deleteButton.click(()=>{
    console.log('delete button was clicked')
})





/*

// FUNCIÓN CALLBACK DE BOTÓN "Eliminar"
function eliminarProducto() {
    if( confirm("¿De verdad deseas eliminar el Producto?") ) {
        var id = event.target.parentElement.parentElement.getAttribute("productId");
        //NOTA: OTRA FORMA PODRÍA SER USANDO EL NOMBRE DE LA CLASE, COMO EN LA PRÁCTICA 7

        // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
        var client = getXMLHttpRequest();
        client.open('GET', './backend/product-delete.php?id='+id, true);
        client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log(client.responseText);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(client.responseText);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;

                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;

                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
            }
        };
        client.send();
    }
}
*/