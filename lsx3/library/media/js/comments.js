$(document).ready(function()
{
    // $('#comment-form').validate({
    //     rules: {
    //         email: {
    //             email:true
    //         }
    //     }
    // });

    var VALI = $('form#comment-form').validate({
        invalidHandler:null
        ,showErrors:null
        ,rules:{
            email:{
                required:true
                ,email:true
            }
            ,comment: {
                required:true
            }
            ,url : {
                url:true
            }
        }
    });

    $("#url").change(function()
    {
        // don't bother if it's an empty string as it's an optional element.
        var str = $.trim($(this).val());
        if (str == '') return;
        
        var res = VALI.element('#url');
        
        if (!res) 
        {
            $("label[for='url']").removeClass('fine');
            $("label[for='url']").addClass('wrong');
        }
        else 
        {
            $("label[for='url']").addClass('fine');   
            $("label[for='url']").removeClass('wrong');   
        }
    });

    $("#email").change(function()
    {
    
        var res = VALI.element('#email');
        
        if (!res) 
        {
            $("label[for='email']").removeClass('fine');
            $("label[for='email']").addClass('wrong');
        }
        else 
        {
            $("label[for='email']").addClass('fine');   
            $("label[for='email']").removeClass('wrong');   
        }
    });
    
    $('#author').change(function()
    {
        console.log($(this).val());
        var str = $.trim($(this).val());
        if (str == '') 
        {
            $("label[for='author']").removeClass('fine');
            $("label[for='author']").addClass('wrong');
        }
        else 
        {
            $("label[for='author']").addClass('fine');   
            $("label[for='author']").removeClass('wrong');   
        }
    });
    
    $('#author').trigger('change');
    $('#email').trigger('change');
    
});