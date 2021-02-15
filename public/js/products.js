$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.custom-select').on('change', function() {

    var id = $(this).parent().parent().parent().find('#btnAddBread').data('id');
    var control = $(this);
    var optionCost = parseFloat($('#select option:selected').data('value'));
    console.log(optionCost);
    if (isNaN(optionCost)) {
        optionCost = 0;
    }

    $.ajax({
        url: '/calculatePrice',
        type: 'post',
        data: { 'id': id, 'optionCost': optionCost },
        dataType: 'json',
        success: function(data) {
            control.parent().parent().parent().find('#price_tag').text('$ ' + data.Price);
        }
    });
});

$(document).on('click', '#btnAddBread', function() {
    var id = $(this).data('id');
    var option = $(this).parent().parent().parent().find('#select option:selected').text();
    var optionCost = $(this).parent().parent().parent().find('#select option:selected').data('value');

    var productName = $(this).data('productname') + '-' + option;
    $.ajax({
        url: '/addBread',
        type: 'post',
        data: { 'id': id, 'option': option, 'optionCost': optionCost },
        dataType: 'json',
        success: function(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: productName + ' has been added to Cart'
            })
        },
        error: function(xhr, status, errstat) {

        },
        complete: function() {

        }
    })
});

$(document).on('click', '#btnAddPop', function() {
    var id = $(this).data('id');
    var productName = $(this).data('productname');
    $.ajax({
        url: '/addPop',
        type: 'post',
        data: { 'id': id },
        dataType: 'json',
        success: function(data) {
            if (data.result == 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: productName + ' has been added to Cart'
                });
            } else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Unable to add ' + productName + ' in Cart',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        },
        error: function(xhr, status, errstat) {

        },
        complete: function() {

        }
    })
});

$(document).on('click', '#btnAddWing', function() {
    var id = $(this).data('id');
    var name = id + '_rdoSauce';
    var productName = $(this).data('productname');
    var option = $(this).parent().parent().parent().find('#select option:selected').text();
    var sauceMix = $(this).parent().parent().parent().find('input[name="' + name + '"]:checked').val();
    $.ajax({
        url: '/addWings',
        type: 'post',
        data: { 'id': id, 'option': option, 'sauceMix': sauceMix },
        dataType: 'json',
        success: function(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: productName + ' has been added to Cart'
            })
        },
        error: function(xhr, status, errstat) {

        },
        complete: function() {

        }
    })
});


$(document).on('click', '#btnAddSide', function() {
    var id = $(this).data('id');
    var productName = $(this).data('productname');
    $.ajax({
        url: '/addSide',
        type: 'post',
        data: { 'id': id },
        dataType: 'json',
        success: function(data) {
            if (data.result == 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: productName + ' has been added to Cart'
                })
            }
        },
        error: function(xhr, status, errstat) {

        },
        complete: function() {

        }
    })
});

$(document).ready(function() {
    $('input[type="radio"]').on('change', function() {
        $(this).parent().parent().find('input:checkbox:first').prop('checked', false);
    });

    $('input[type="checkbox"]').on('change', function() {
        if ($(this).parent().parent().find('input:radio').is(':checked')) {
            var controlName = $(this).parent().parent().find('input:radio:checked').val().split('_')
            console.log(controlName);
            if (!controlName[2]) {
                $(this).parent().parent().find('input:radio:checked').attr('value', controlName[0] + '_' + controlName[1] + '_2x');
            } else {
                $(this).parent().parent().find('input:radio:checked').attr('value', controlName[0] + '_' + controlName[1]);
            }
        }
    });
});