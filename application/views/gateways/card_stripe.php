<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.6/featherlight.min.css">
<style>
    #processing {
        display: none;
    }

    #result {
        padding: 15px;
        display: none;
    }

    #iframe-container iframe {
        width: 100%;
        height: 400px;
    }

</style>


<?php
$rming = $invoice['total'] - $invoice['pamnt'];
if ($itype == 'rinv' && $invoice['status'] == 'due') {
    $rming = $invoice['total'];
}
$surcharge_t = false;

$row = $gateway;

$cid = $row['id'];
$title = $row['name'];
if ($row['surcharge'] > 0) {
    $surcharge_t = true;
    $fee = '( ' . amountExchange($rming, $invoice['multi']) . '+' . amountFormat_s($row['surcharge']) . ' %)';
     $rming =$rming+ ($rming * $row['surcharge']) / 100;
} else {
    $fee = '';


}
if($rming==0) redirect("billing/view?id=$tid&token=$token");
?><div class="app-content content container-fluid">  <div class="content-wrapper">
<div class="card">

    <div class="card-header">
        <h1>Stripe Payment Page</h1>

    </div>
    <div class="card-body card-block">
        <p id="result" class="bg-info"></p>
        <div class="col-md-4">
            <button class="btn btn-primary btn-block m-2" onclick="pay()" id="pay_button">Pay With Stripe Secure</button>
        </div>

        <div class="col-md-12"><div id="token_response"></div></div>


        <div id="processing">
            <p class="text-center">Processing...</p>
        </div>

        <div id="modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" id="iframe-container">
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div></div>
<div class="row">

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.6/featherlight.min.js"></script>

<script src="https://checkout.stripe.com/checkout.js"></script>

<script type="text/javascript">
    function pay() {
        var handler = StripeCheckout.configure({
            key: '<?=$row['key2']; ?>', // your publisher key id
            locale: 'auto',
            token: function (token) {
                $('#token_response').hide();
                $('#pay_button').hide();
                $('#processing').show();
// You can access the token ID with `token.id`.
// Get the token ID to your server-side code for use.
                console.log('Token Created!!');

                $.ajax({
                    url: '<?php echo base_url('billing/process_card') ?>',
                    method: 'post',
                    //data: { tokenId: token.id, amount: amount },
                    data: 'token_s=' + token.id + '&s_amount=' +'' + '&amount=' + '' + '&currency=' + '' + '&id=<?= $invoice['tid']; ?>&token=<?= $token ?>&itype=<?= $itype ?>&gateway=<?= $gid ?>&<?=$this->security->get_csrf_token_name(); ?>=<?=$this->security->get_csrf_hash(); ?>',
                    dataType: "json",
                    success: function( data ) {

                        if (data.status == 'Success'){

                            $('#token_response').show();
                            $('#processing').hide();
                            window.location.replace('<?=base_url('billing/'.$view_st.'?id=' . $invoice['tid'] . '&token=' . $token)?>');
                        } else {

                            $('#token_response').show();
                            $('#pay_button').show();
                            $('#processing').hide();
                            $('#token_response').append( '<div class="alert alert-danger">' + data.message+'</div');
                        }


                    }
                })
            }
        });
        handler.open({
            name: '<?=$this->config->item('ctitle')?> Pay',
            description: '<?=$this->config->item('city')?>',
            amount: <?php if ($rming > 0) { $tt_s=$rming * 100; $tt_s=number_format($tt_s,0,'',''); echo $tt_s; } else {echo '0';} ?>
        });
    }
</script>