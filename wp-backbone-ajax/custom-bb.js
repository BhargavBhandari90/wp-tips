jQuery(document).ready(function($) {

    var ajaxModel = Backbone.Model.extend({
    });

    var ajaxCollection = Backbone.Collection.extend({
        model : ajaxModel,
        url   : 'http://localhost:8888/wordpress/wp-admin/admin-ajax.php',
    });

    var coll = new ajaxCollection;


    var ajaxView = Backbone.View.extend({
        initialize: function() {

            // var ajaxurl = 'http://localhost:8888/wordpress/wp-admin/admin-ajax.php';


            // var data = {
            //     'action': 'my_action',
            //     'whatever': 1234
            // };

            // // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            // jQuery.post(ajaxurl, data, function(response) {
            //     // alert('Got this from the server: ' + response);
            //     console.log(response.data);
            //     ajaxView.render(response.data);
            // });

        },

        events: {
            'click #click-button' : 'test_call'
        },

        test_call : function() {

            var that = this;

            coll.fetch({
                data : {
                    'action': 'my_action',
                    'whatever': 1234
                },
                success: function(collection, object, jqXHR) {
                    that.render(object.data);
                  },
                  error: function(jqXHR, statusText, error) {
                    console.log('11111---333');
                  }
            });
        },

        el: jQuery('#experiment-plugin-element'),

        template : _.template( jQuery( '#experiment-item-template' ).html() ),

        render: function(response) {

            var that = this;

            $.each( response, function( key, cposts ) {
                that.$el.append( that.template(cposts) );
            } );
        },
    });

    var aview = new ajaxView;

});
