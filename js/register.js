$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault(); 
        let formData = $(this).serialize(); 
        $.ajax({
            url: 'php/register.php',
            type: 'POST',
            data: formData,
            success:function(response){
                alert(response);
                if(response.trim()==="New record created successfully")
                {
                window.location.href="login.html";
                }else{
                    alert(response);
                }
            }
        })
    });
});