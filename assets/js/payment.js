paypal.Buttons({
    style:{
        color:'blue',
        shape:'pill'
    },
    createOrder: function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amout : {
                    value: '0.1'
                }
            }]
        });
    },
    onApprove:function(data,actions){
        return actions.order.capture().then(function(details){
            console.log(details)
        })
    }
}).render('#paypal-payment-button');


