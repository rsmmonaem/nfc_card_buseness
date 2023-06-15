"use strict";

function generate_qr() {
    $('.code').empty().qrcode({
        render: 'image',
        size: 1000,
        ecLevel: 'H',
        minVersion: 3,
        quiet: 1,
        text: card_url,
        fill: $('.foreground_color').val(),
        background: $('.background_color').val(),
        radius: .01 * parseInt($('.corner_radius').val(), 10),
        mode: parseInt($('#qr_type').val(), 10),
        label: $('.text').val(),
        fontcolor: $('.text_color').val(),
        image: $("#image-buffer")[0],
        mSize: .01 * parseInt($('.size').val(), 10)
    });
}

$('#qr_type').on('change', function () {
var qr_type_val = $(this).val();
if(qr_type_val == 0){
    $('#qr_type_option').slideUp();
}else if(qr_type_val == 2){
    $('#qr_type_option').slideDown();
    $('#text_div').slideDown();
    $('#image_div').slideUp();
} else if(qr_type_val == 4){
    $('#qr_type_option').slideDown();
    $('#text_div').slideUp();
    $('#image_div').slideDown();
}
}).trigger('change');


$('.download_my_qr_code').on('click', function (e) {
e.preventDefault();
var img = new Image();
img.src = $('.code').find('img').attr('src');
img.onload = function () {
        var canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);
        var data = canvas.toDataURL('image/png');
        var a = document.createElement("a");
        a.download = "qr-code.png";
        a.href = data;
        a.click();
    };
});

$('input, select').on('input change', function () {
    generate_qr();
});
   
$('.image').on('change', function () {
var img_reader, img_input = $('.image')[0];
img_input.files && img_input.files[0] && ((img_reader = new window.FileReader).onload = function (event) {
    $("#image-buffer").attr("src", event.target.result);
    setTimeout(generate_qr, 250)
}, img_reader.readAsDataURL(img_input.files[0]))
});

generate_qr();

