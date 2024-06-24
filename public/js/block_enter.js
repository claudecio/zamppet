$(document).ready(function ()
    {
        // Impede o envio do formulário ao pressionar "Enter"
        $('form').on('keypress', function (e)
        {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });
    });