<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add to cart test</h1>
    <div>
        <?php 
        if(isset($_SESSION['cart'])) {
        var_dump($_SESSION['cart']);
        }
        ?>
    </div>
        <button data-menuid="1" id="btn">Add to cart (1)</button>
    <script>
        const addToCartBtn = document.querySelector("#btn");
        addToCartBtn.addEventListener('click', (e) => {
            const menuid = e.target.getAttribute('data-menuid');
            fetch("./inc/addtocart.php", { // fetch the file
            method: "POST", // POST method
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, // set the content type
            body: "add=" + menuid // value of the input
        }).then(function (response) { // when the response is returned
            return response.text(); // return the response
        }).then(function (response) { // when the response is returned
            console.log(response);
        });

        });
    </script>
</body>
</html>