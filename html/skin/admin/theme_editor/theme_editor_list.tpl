<html>
    <head>
       
        <script src="<%SKINS_PATH%>js/jquery-1.5.2.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.js"></script>
  <link rel="stylesheet" media="screen" type="text/css" href="<%SKINS_PATH%>css/jquery-ui-1.8.18.custom.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<%SKINS_PATH%>css/theme_editor.css" />
        
    </head>
    <body>
        <script src="<%SKINS_PATH%>js/colorpicker/colorpicker.js" type="text/javascript"></script>
         <link rel="stylesheet" media="screen" type="text/css" href="<%SKINS_PATH%>css/colorpicker.css" />
        <script type="text/javascript">
            $(function(){
                setTimeout(init, 3000);

                function init(){
                    var site = $('#preview').contents();
                    $(site).find('a').each(function(){
                        $(this).attr('href','#');
                        $(this).attr('onclick','return false');
                    });
                }

                function getSelector(element, prefix){
                    var id = $(element).attr('id').replace(prefix,'');
                    
                    var pattern = id.replace('id__','#');
                    var pattern = pattern.replace('class__','.');

                    var selector = pattern.replace(/\_\_/gi,' ');

                    return selector;
                }


                $('.slider').slider({
                    min: 8,
                    max: 13,
                    step: 1,
                    slide: function(event, ui){
                        var value = ui.value;

                        var property = $(this).prev().attr('class').replace('slider ','');
                        var selector = getSelector(this, 'slider_');

                        console.log(property);
                        var site = $('#preview').contents();
                        $(site).find(selector).css(property,value + 'px');
                    }
                });

                $('.list li').click(function(){
                    var property =  $(this).parent().prev().attr('class');
                    var selector = getSelector($(this).parent(), 'list_');
                    var value = $(this).text();

                    console.log(property);

                    var site = $('#preview').contents();
                    $(site).find(selector).css(property,value);
                });

                $('.colorpick').ColorPicker({
                        color: '#0000ff',
                        onShow: function (colpkr) {
                                $(colpkr).fadeIn(500);
                                return false;
                        },
                        onHide: function (colpkr) {
                                $(colpkr).fadeOut(500);
                                return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                        },
                        onSubmit: function(hsb, hex, rgb, el){
                                $(el).css('backgroundColor', '#' + hex);
                                var property =  $(el).attr('name');
                                var selector = getSelector(el, 'color_');
                                var site = $('#preview').contents();
                                $(site).find(selector).css(property,'#' + hex);
                        }
                    });

                    $('.property').change(function(){
                        var selector = getSelector(this, 'property_');

                        var property =  $(this).attr('name');
                        var site = $('#preview').contents();
                        $(site).find(selector).css(property,$(this).val());
                    });
            });
            
        </script>
        <div class="left">
            <div class="section">
                <div class="logo"></div>
                <h1>Control menu</h1>
            </div>
            <div class="control_menu">
                <h3>Page header</h3>
                <ul>
                    <li>
                        Top navigation:<br />
                        <span class="font-size">font-size:</span>
                        <div class="slider" id="slider_id__account_info__a" style="width: 200px"></div>
                    </li>
                    <li>
                        <span class="font-weight">font-weight</span>
                        <ul id="list_id__account_info__a" class="list">
                            <li>normal</li>
                            <li>bold</li>
                            <li>bolder</li>
                        </ul>
                    </li>
                    <li>
                        <span class="text-decoration">text-decoration</span>
                        <ul id="list_id__account_info__a" class="list">
                            <li>none</li>
                            <li>blink</li>
                            <li>line-through</li>
                            <li>overline</li>
                            <li>underline</li>
                        </ul>
                    </li>
                    <li><%TOP_NAV_TEXT_DECORATION%></li>
                    <li>
                        Top nav color:<br />
                        <input type="text" name="color" id="color_id__account_info__a" class="colorpick" />
                    </li>
                </ul>
                <ul>
                    <li >
                        Main nav color:<br />
                        <input type="text" name="color" id="color_id__header_links__a" class="colorpick" />
                    </li>
                    <li >
                        Top nav color:<br />
                        <input type="text" name="color" id="color_id__account_info__a" class="colorpick" />
                    </li>
                    <li >
                        Feature products:<br />
                        <input type="text" name="background-color" id="color_id__featured-products_block_center__h4" class="colorpick" />
                        <input type="text" name="color" id="color_id__featured-products_block_center__h4" class="colorpick" />
                    </li>
                    <li>
                        Product link color:<br />
                        <input type="text" name="color" id="color_class__product_link" class="colorpick" />
                    </li>
                    <li>
                        Product image style:<br />
                        <input type="text" name="border-radius" id="property_class__product_image__img" class="property" /><br />
                        <input type="text" name="-moz-border-radius" id="property_class__product_image__img" class="property" />
                    </li>
                    <li>
                        Main container:<br />
                        <input type="text" name="border-radius" id="property_id__columns_inner" class="property" /><br />
                        <input type="text" name="-moz-border-radius" id="property_id__columns_inner" class="property" />
                    </li>
                </ul>
            </div>
        </div>
        <div class="right">
            <iframe id="preview" src="../index.php">

            </iframe>
        </div>
    </body>
</html>