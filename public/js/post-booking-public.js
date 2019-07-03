(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

})(jQuery);

function displayBookingSpace() {
    var bookingSpace = document.getElementById('booking-space');
    bookingSpaceHtml = '';
    bookingSpaceHtml = '<form id="payment_form" method="post"> ';
    bookingSpaceHtml += '<div class="payment-errors" style="color:red;"> </div>';
    bookingSpaceHtml += '<div class="form-group" id="insription_connexion">';
    bookingSpaceHtml += '</div>';
    bookingSpaceHtml += '<div class="panel panel-default credit-card-box">';
    bookingSpaceHtml += '<div class="panel-heading display-table" style="min-width:523px;" >';
    bookingSpaceHtml += '        <div class="row display-tr" >';
    bookingSpaceHtml += '               <h3 class="panel-title display-td" >Détails paiement</h3>';
    bookingSpaceHtml += '           <div class="display-td" > ';
    bookingSpaceHtml += '                <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">';
    bookingSpaceHtml += '            </div>';
    bookingSpaceHtml += '        </div>';
    bookingSpaceHtml += '    </div>';
    bookingSpaceHtml += '  <div class="panel-body">';
    bookingSpaceHtml += '            <div class="row">';
    bookingSpaceHtml += '                <div class="col-xs-12">';
    bookingSpaceHtml += '                    <div class="form-group" style="max-width:523px;">';
    bookingSpaceHtml += '                        <label for="cardNumber">Numéro de carte</label>';
    bookingSpaceHtml += '                        <div class="input-group">';
    bookingSpaceHtml += '                            <input type="tel" id="card-number" class="form-control card-number"  name="cardNumber" placeholder="Numéro de carte" required/>';
    bookingSpaceHtml += '                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>';
    bookingSpaceHtml += '                        </div>';
    bookingSpaceHtml += '                    </div>      ';
    bookingSpaceHtml += '                </div>';
    bookingSpaceHtml += '            </div>';
    bookingSpaceHtml += '            <div class="row">';
    bookingSpaceHtml += '                <div class="col-xs-3 col-md-2">';
    bookingSpaceHtml += '                    <div class="form-group">';
    bookingSpaceHtml += '                 <label for="" style="position:relative;left:40px;">Date</label>';
    bookingSpaceHtml += '                        <input type="tel" id="card-expiry-month"  class="form-control card-expiry-month " maxlength="2" size="2"  placeholder="MM" autocomplete="cc-exp" required />';
    bookingSpaceHtml += '                    </div>';
    bookingSpaceHtml += '                </div>';
    bookingSpaceHtml += '                <div class="col-xs-4 col-md-4">';
    bookingSpaceHtml += '                    <div class="form-group">';
    bookingSpaceHtml += '                 <label style="position:relative;right:40px;">d\'expiration</label>';
    bookingSpaceHtml += '                        <input type="tel" id="card-expiry-year"  class="form-control card-expiry-year" maxlength="4" size="4"  placeholder="AAAA" autocomplete="cc-exp" required />';
    bookingSpaceHtml += '                    </div>';
    bookingSpaceHtml += '                </div>';
    bookingSpaceHtml += '                <div class="col-xs-4 col-md-4 pull-right">';
    bookingSpaceHtml += '                    <div class="form-group">';
    bookingSpaceHtml += '                 <label for="cardCVC" >CODE CVC</label>';
    bookingSpaceHtml += '                        <input  type="tel"  id="card-cvc" class="form-control card-cvc" maxlength="3" size="3"  placeholder="CVC" required/>';
    bookingSpaceHtml += '                    </div>';
    bookingSpaceHtml += '                </div>';
    bookingSpaceHtml += '            </div>';
    bookingSpaceHtml += '            <div class="row">';
    bookingSpaceHtml += '                <div class="col-xs-12">';
    bookingSpaceHtml += '                   <button id="send_payment" class="subscribe btn btn-success btn-lg btn-block" type="submit">Start Subscription</button>';
    bookingSpaceHtml += '                </div>';

    bookingSpaceHtml += '            </div>';
    bookingSpaceHtml += '    </div>';
    bookingSpaceHtml += '</div>      ';
    bookingSpaceHtml += '</form>      ';

    var stripe_public_key = document.getElementById('pb_stripe_public_key').getAttribute('value');

    if (bookingSpace != null) {
        bookingSpace.innerHTML = bookingSpaceHtml;
    }
    var submit_url = document.getElementById('pb_form_submit_url');
    if (submit_url != null && stripe_public_key != null) {
        var form = document.getElementById('payment_form');
        Stripe.setPublishableKey(stripe_public_key);
        form.setAttribute('action', submit_url.getAttribute('value'));
        form.onsubmit = function(e) {
            var card_number = document.getElementById('card-number').value;
            var card_cvc = document.getElementById('card-cvc').value;
            var card_exp_month = document.getElementById('card-expiry-month').value;
            var card_exp_year = document.getElementById('card-expiry-year').value;
            console.log(stripe_public_key);
            console.log(card_number);
            console.log(card_cvc);
            console.log(card_exp_month);
            console.log(card_exp_year);
            e.preventDefault();
            document.getElementById('send_payment').setAttribute('disabled', true);
            Stripe.card.createToken({
                number: card_number, cvc: card_cvc, exp_month: card_exp_month, exp_year: card_exp_year
            }, function(status, response) {
                console.log(response);
                if (response.error) { // Ah une erreur !
                    //form.getElementsByClassName('.payment-errors')[0]).inner ('Informations de carte erronées');
                    //form.getElementsByTagName('button')[0].prop('disabled', false); // On réactive le bouton
                } else { // Le token a bien été créé
                    var token = response.id; // On récupère le token
                    var tokenElement = document.createElement('input');
                    tokenElement.setAttribute('type', 'hidden');
                    tokenElement.setAttribute('name', 'stripeToken');
                    tokenElement.setAttribute('value', token);
                    form.append(tokenElement);
                    form.submit(); // On soumet le formulaire
                }
            });

        };
    }
}