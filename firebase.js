window.onload = function () {
    render();
};

function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}

function phoneAuth() {
    return new Promise((resolve, reject) => {
        var number = "+92" + document.getElementById('mobile_number').value;
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
            .then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                console.log(confirmationResult);
                resolve({ "status": true, "result": confirmationResult });
            })
            .catch(function (error) {
                console.log(error);
                resolve({ "status": false, "error": error });
            });
    });
}


function codeverify() {
    return new Promise((resolve, reject) => {
        var code = document.getElementById('otp').value;
        window.confirmationResult.confirm(code)
            .then(function (result) {
                resolve({ "status": true, "result": result });
            })
            .catch(function (error) {
                console.log(error);
                resolve({ "status": false, "error": error });
            });
    });
}
