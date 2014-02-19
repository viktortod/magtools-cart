shop = new function(){
    
};

function getJsonSize(element){
    var key, count = 0;

    for(key in element) {
      count++;
    }

    return count;
}

shop.UICart = new function(){
    

    this.init = function(){
        var products = {};
        var totalSum = 0;
        var shipping = 0;
        
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'cart.php',
            success: function(response){
                products = response.products;
                totalSum = parseFloat(response.total).toFixed(2);
                shipping = parseFloat(response.shipping).toFixed(2);

                var productsCount = products.length;

                $('.ajax_cart_quantity').html(productsCount);
                $('.ajax_cart_total').html(totalSum);
                $('.ajax_block_cart_total').html(totalSum + ' лв.');
                $('.ajax_cart_shipping_cost').html(shipping + ' лв.');
                var html = '';
                
                if( getJsonSize(response.products) > 0){
                    for(var productKey in products){

                        var product = products[productKey];
                        html += '<div id="product_item" style="clear: both;">';
                        html += ' <span class="quantity-formated"><span class="quantity">';
                        html +=  product.quantity + '</span> x </span>';
                        html += ' <a class="cart_block_product_name">' + product.ProductName + '</a>';
                        html += '<span class="remove_link">'
                        html += ' <a id="DeleteProduct_' + product.ProductID + '" class="ajax_cart_block_remove_link">';

                        html += '</a>';
    //                    html += 'X';
                        html += '</span>';
                        html += '<span class="price">';
                        html += product.ProductGlobalPrice + ' лв.';
                        html += '</span>';
                        html += '<br style="clear: both;" />';
                        html += '</div>';
                    }
                }
                else{
                    html = 'No Products';
                    $('.ajax_cart_shipping_cost').html('0.00 лв.');
                    $('.ajax_block_cart_total').html('0.00 лв.');
                }

                $('#cart_block_products').html(html);

                $('.ajax_cart_block_remove_link').click(function(){
                    var productId = $(this).attr('id').split('_')[1];
                    shop.UICart.removeProduct(productId);
                });
            }
        });
        
        
    };


    this.getProducts = function(){
        return products;
    };

    this.getProductsCount = function(){
        return products.size();
    };

    this.addProduct = function(id, quantity){
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: 'action=add&ProductId=' + id + '&quantity=' + quantity,
            url: 'cart.php',
            success: function(response){
                shop.UICart.init();
            }
        });
    };

    this.removeProduct = function(id){
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: 'action=remove&ProductId=' + id,
            url: 'cart.php',
            success: function(response){
                shop.UICart.init();
            }
        });
    }
};


shop.Popup = function(){
    this.content = '';
    this.title = '';

    this.setContent = function(content){
        this.content = content;
    }

    this.getContent = function(){
        return this.content;
    }

    this.setTitle = function(title){
        this.title = title;
    }

    this.showPopup = function(){
        $('#index').append('<div class="popup"><div class="popup-title"></div><div class="popup-content"></div></div><div class="popup-background"></div>');
        $('.popup-title').html(this.title + '<div class="popup-close-btn"></div>');
        $('.popup-content').html(this.content);

        $('.popup-background').dblclick(function(){
            $('.popup-close-btn').click();
        });

        $('.popup-close-btn').click(function(){
                        $('.popup').remove();
            $('.popup-background').remove();
        });
        
    }
}

$(function(){
    $('#login-btn').click(function(){
        var popup = new shop.Popup();
        var loginHtml = '<div class="login-popup-form">';
        loginHtml += '<div class="login-popup-form-section">';
        loginHtml += '<h3>Register</h3>';
        loginHtml += '<div class="form">';
        loginHtml += '<form method="POST" action="register.php?action=checkRegistration">';
        loginHtml += '<label>Enter your email</label>';
        loginHtml += '<input type="text" name="CustomerEmail" />';
        loginHtml += '<br />';
        loginHtml += '<input type="submit" class="exclusive_small" name="RegisterEmail" value="Register" />';
        loginHtml += '</form>';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="login-popup-form-section">';
        loginHtml += '<h3>Login</h3>';
        loginHtml += '<div class="form">';
         loginHtml += '<form method="POST" action="login.php?action=doLogin">';
        loginHtml += '<label>Enter your email</label>';
        loginHtml += '<input type="text" name="CustomerEmail" />';
        loginHtml += '<label>Password</label>';
        loginHtml += '<input type="password" name="CustomerPassword" />';
        loginHtml += '<br />';
        loginHtml += '<input type="button" class="exclusive_small" name="PasswordRestoreBtn" value="Forgotten password" />';
        loginHtml += '<input type="submit" class="exclusive_small" name="LoginBtn" value="Login" />';
        loginHtml += '</form>';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '</div>';

        popup.setTitle('Please login');
        popup.setContent(loginHtml);
        popup.showPopup();
    });


    $('.error').each(function(){
        $(this).parent().append('<div class="fieldErrorMsg">' + $(this).attr('errormsg') + '</div>');
    });
});
