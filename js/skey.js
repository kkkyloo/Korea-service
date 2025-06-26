var button = document.getElementById("secretbutton2");

button.addEventListener("click", function() {
    var newValue = "secretkey";
    var secretInput = document.querySelector('[name="secret1"]');
    secretInput.value = newValue;
});
