
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type: "PUT"};

$(document).ready(function(){

    $('.set-guide-number').editable();
    $('.select-status').editable({
        source: [
            {value: 'created', text: 'Created'},
            {value: 'sent', text: 'Sent'},
            {value: 'recieved', text: 'Recieved'},
        ]
    });

    $('.add-to-cart').on('submit',function(ev){
        ev.preventDefault();
        var $form = $(this);
        var $button = $form.find("[type='submit']");

        // peticion ajax
        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            dataType:'JSON',
            beforeSend: function(){
                $button.val('Cargando...');
            },

            success: function(data){
                $('.circle-shopping-cart').html(data.products_count).addClass('highlight');
                $button.css('background-color','#00c853').val('Agregado');
                console.log(data);
                setTimeout(function(){
                    restartButton($button);
                },2000);
            },

            error: function(err){
                console.log(err);
                $button.css('background-color','#d50000').val("Hubo un error");
                setTimeout(function(){
                    restartButton($button);
                },2000);
            }
        });

        return false;
    });

    function restartButton($button){
        $button.val("Agregar al Carrito").attr("style",'');
        $('.circle-shopping-cart').removeClass('highlight');

    }


});
