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
                tableRows += getRowTemplate(product);
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
                tableRows += getRowTemplate(product);
                template_bar += ` <li>${product.nombre}</il>`;
            });
            const productsTableBody = $('#products');
            productsTableBody.html(tableRows)
            showMessageInContainer(template_bar)
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
    const validations = validateProductData(productData, true);
    if(validations.length > 0){
        let validationsTemplate = '';
        validations.forEach(validation => {
            validationsTemplate +=  `<li>${validation}</li>`
        })
        showMessageInContainer(validationsTemplate)
    }
    else{
        $.post({
            url: "./backend/product-add.php",
            data:  JSON.stringify(productData),
            success: ( result ) => {
                const response = JSON.parse(result);
                if(response.status == "success"){
                    showMessageInContainer('<li>Producto agregado exitosamente!</li>')
                    listAllProducts();
                }
                else{
                    showMessageInContainer(
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

/********* Delete product *********/
$(document).on('click', '.product-delete', function (event) {
    event.preventDefault();
    var productId = event.target.parentElement.parentElement.getAttribute("productId");
    if( confirm("¿De verdad deseas eliminar el Producto?") ) {
        $.ajax({
            url: "./backend/product-delete.php?" + $.param({ id: productId }),
            type: "put",
            success: ( result ) => {
                showMessageInContainer('Producto eliminado exitosamente! :)')
                listAllProducts();
            }
        })
    }

});

/********* Edit product *********/

$(document).on('click', '.product-update', function (event) {
    event.preventDefault();
    var productId = event.target.parentElement.parentElement.getAttribute("productId");
    $.ajax({
        url: "./backend/product-get-info.php?" + $.param({ id: productId }),
        type: "get",
        success: ( result ) => {
            const productInfo = JSON.parse(result)
            const productDetailsJson = {
                "precio": productInfo.precio,
                "unidades": productInfo.unidades,
                "modelo": productInfo.modelo,
                "marca": productInfo.marca,
                "detalles": productInfo.detalles,
                "imagen": productInfo.imagen
            }
            var productDetailsJsonString = JSON.stringify(productDetailsJson,null,2);
            $('#name').val(productInfo.nombre);
            $("#description").val(productDetailsJsonString);
            // Escondemos boton para agregar producto
            $('.btn-primary').addClass('d-none');
            // Hacemos el boton de edicion visible
            const className = $('#editProductBtn').attr('class');
            const currentProductId = className.split('productId-')[1];
            $('#editProductBtn').removeClass('d-none').removeClass(`productId-${currentProductId}`).addClass(`productId-${productId}`)
        }
    })
});

$('#editProductBtn').click(()=>{
    const productDetails = $("#description").val();
    const className = $('#editProductBtn').attr('class');
    const productId = className.split('productId-')[1];

    const validations = validateProductData(JSON.parse(productDetails), false);
    if(validations.length > 0){
        let validationsTemplate = '';
        validations.forEach(validation => {
            validationsTemplate +=  `<li>${validation}</li>`
        })
        showMessageInContainer(validationsTemplate)
    }
    else{
        $.ajax({
            url: "./backend/product-edit.php?" + $.param({ id: productId }),
            type: "put",
            data: productDetails,
            success: ( result ) => {
                const response = JSON.parse(result);
                if(response.status == "success"){
                    showMessageInContainer('<li>Producto editado exitosamente!</li>')
                    listAllProducts();
                }
                else{
                    showMessageInContainer(
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
        // Hacemos visible el boton para agregar producto
        $('.btn-primary').removeClass('d-none');
        // Escondemos el boton para editar producto
        $('#editProductBtn').addClass('d-none').removeClass(`productId-${productId}`)
        // regresamos a la base original
        $('#name').val('');
        const baseJsonString = JSON.stringify(baseJSON,null,2);
        $("#description").val(baseJsonString);
    }
})


/********* Helper Methods *********/
function validateProductData(data, isAddValidation)
{
    if(isAddValidation){
        data.precio = parseInt(data.precio)
        data.unidades = parseInt(data.unidades)
    }
    let response = [];
    if (isAddValidation && data.nombre == '') (response = ['El nombre es obligatorio'])
    if (data.precio <= 0) response = [...response, 'El precio debe ser mayor a 0']
    if (data.unidades <= 0) response = [...response, 'Las unidades deben ser mayores a 0']
    if (data.modelo <= '') response = [...response, 'El modelo es obligatorio']
    if (data.marca <= '') response = [...response, 'La marca es obligatoria']

    return response;
}

function showMessageInContainer(message){
    $('#product-result').addClass('card my-4 d-block')
    $('#container').html(message)
}


function getRowTemplate(product){
    tableRow =
    `
    <tr productId="${product.id}">
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
        <td>
            <button class="product-update btn btn-warning" type="button">
                Editar
            </button>
        </td>
    </tr>
    `

    return tableRow
}