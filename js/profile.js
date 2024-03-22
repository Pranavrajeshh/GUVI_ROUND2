$(document).ready(function() {
    var username = localStorage.getItem('username');

    if (username) {
        console.log(username);
        $.ajax({
            type: 'GET',
            url: 'php/profile.php',
            data: { username: username },
            success: function(response) {
                var userInfo = JSON.parse(response);
                console.log(userInfo);
                $('#yes').text(userInfo.username);
                $('#username').text(userInfo.username);
                $('#age').text(userInfo.age);
                $('#location').text(userInfo.location);
                $('#nation').text(userInfo.nation);
            },
            error: function(xhr, status, error) {
                console.error("Error retrieving user information:", error);
            }
        });
    } else {
        console.log("No username found in local storage.");
    }
    $('#updateForm').submit(function(e) {
        e.preventDefault(); 
        console.log("function caleed");
        var formData = $(this).serialize();
        formData += '&username=' + encodeURIComponent(username);
        console.log(formData)

        
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: formData,
            success: function(response) {
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error("Error updating user profile:", error);
            }
        });
    });
});