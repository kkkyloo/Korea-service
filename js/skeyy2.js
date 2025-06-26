// Проверяем существование кнопки и присваиваем переменной
var button = document.getElementById("secretbutton");
if (button) {
    button.addEventListener("click", setSecretValue);
}

// Проверяем существование второй кнопки и присваиваем переменной
var button2 = document.getElementById("secretbutton2");
if (button2) {
    button2.addEventListener("click", setSecretValue);
}

// Проверяем существование третьей кнопки и присваиваем переменной
var button3 = document.getElementById("secretbutton3");
if (button3) {
    button3.addEventListener("click", setSecretValue);
}

function setSecretValue() {
    var newValue = "secretkey";

    // Находим элементы по имени атрибута
    var secretInput = document.querySelector('[name="secret"]');
    var secretInput2 = document.querySelector('[name="secret2"]');
    var secretInput3 = document.querySelector('[name="secret3"]');

    // Проверяем, что элементы существуют перед присвоением значения
    if (secretInput) {
        secretInput.value = newValue;
    }
    if (secretInput2) {
        secretInput2.value = newValue;
    }
    if (secretInput3) {
        secretInput3.value = newValue;
    }
}
