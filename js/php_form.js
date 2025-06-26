document.getElementById('myForm').addEventListener('submit', function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', this.action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);

            alert(response.message);

            if (response.status === 'success') {
                location.reload();
            }
        }
    };

    xhr.send(formData);
});