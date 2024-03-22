$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'php/login.php', 
            data: formData,
            success: function(response) {
                if (response.trim() === "LOGGED IN SUCCESSFULLY") {
                    var username = $('#name').val(); 
                    localStorage.setItem('username', username); 
                    window.location.href = 'profile.html';
                } else {
                    console.log(response)
                }
            }
        });
    });
});