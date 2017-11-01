
$(document).ready(function () {
    $(function () {
        $('#order-form').on('submit', function (e) {
            e.preventDefault();

            var
                form=$(this);
                formData=form.serialize();
            console.log(formData);

            $.ajax({
                url: '../php/index.php',
                type: 'POST',
                data: formData
            })

        });
    });
});
