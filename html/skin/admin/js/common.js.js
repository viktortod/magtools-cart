$(function(){
    $('.multipleSelect').css({
        width: '200px',
        height: '350px'
    });

    $('.multipleSelect option').dblclick(function(){
        var element = $(this).parent().attr('id');
        var responseElementSelector = '';

        if(element == 'multiple1'){
            responseElementSelector = '#multiple2';
        }
        else{
            responseElementSelector = '#multiple1';
        }

        $(responseElementSelector).append($(this));
//        $(this).remove();
    });

    $(document).submit(function(){
        $('#multiple2 option').each(function(){
            var currentValue = $('#cats').val();

            if(currentValue != ''){
                currentValue += ',';
            }

            $('#cats').val(currentValue  + $(this).val());
        });

        
    });

    $('.error').each(function(){
        $(this).parent().append('<br /> <div class="fieldErrorMsg">' + $(this).attr('errormsg') + '</div>');
    });
});