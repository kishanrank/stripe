<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>

<body>
    <form id="check-out-form" action="{{ route('charge') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="stripeToken" id="stripeToken">
        <input type="hidden" name="stripeEmail" id="stripeEmail">
        <button type="submit">Buy Now</button>
    </form>


    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        let stripe = StripeCheckout.configure({
            'key': "{{ config('services.stripe.key') }}",
            'image': "https://stripe.com/img/documentation/checkout/marketplace.png",
            'locale': "auto",
            'token': function(token) {
                document.querySelector('#stripeEmail').value = token.email;
                document.querySelector('#stripeToken').value = token.id;
                document.querySelector('#check-out-form').submit();
            }
        });

        document.querySelector('button').addEventListener('click', function(e) {
            stripe.open({
                name: 'My book',
                description: 'This is detail.',
                zipCode: true,
                amount: 25000,
                currency: 'inr'
            });
            e.preventDefault();
        });



    </script>
</body>

</html>