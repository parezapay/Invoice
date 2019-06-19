<div id="headerbar">
    <h1 class="headerbar-title"><?php _trans('payment_logs'); ?></h1>

    <div class="headerbar-item pull-right">
        <?php echo pager(site_url('payments/online_logs'), 'mdl_payments'); ?>
    </div>

</div>

<!-- <div id="content" class="table-content">

    <?php $this->layout->load_view('layout/alerts'); ?>

    <div id="filter_results">
        <div class="table-responsive">
            <table class="table table-striped">

                <thead>
                <tr>
                    <th><?php _trans('payment_date'); ?></th>
                    <th><?php _trans('invoice'); ?></th>
                    <th><?php _trans('transaction_successful'); ?></th>
                    <th><?php _trans('payment_date'); ?></th>
                    <th><?php _trans('payment_provider'); ?></th>
                    <th><?php _trans('provider_response'); ?></th>
                    <th><?php _trans('transaction_reference'); ?></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($payment_logs as $log) { ?>
                    <tr>
                        <td><?php echo $log->merchant_response_id; ?></td>
                        <td>
                            <a href="<?php echo site_url('invoices/view/' . $log->invoice_id); ?>"
                               title="<?php _trans('invoice'); ?>">
                                <?php echo($log->invoice_number ? $log->invoice_number : $log->invoice_id); ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            echo $log->merchant_response_successful
                                ? '<i class="fa fa-check text-success"></i>'
                                : '<i class="fa fa-ban text-danger"></i>';
                            ?>
                        </td>
                        <td><?php echo date_from_mysql($log->merchant_response_date); ?></td>
                        <td><?php echo $log->merchant_response_driver; ?></td>
                        <td class="small <?php echo $log->merchant_response_successful ? '' : 'text-danger'; ?>">
                            <?php echo $log->merchant_response; ?>
                        </td>
                        <td><?php echo $log->merchant_response_reference; ?></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>


    </div>

</div>-->


<div class="table-shadow" style="margin-top: 30px;">
<div class="table-responsive" >
    <table class="table table-striped">

        
        

        
        
       <table id="customers">
  <tr class="tr-head">
    <th>Payment Date</th>
    <th class="due-date">Invoice</th>
    <th class="due-date">Payment Date</th>
    <th>Transaction successful</th>
    <th>Payment Provider</th>
    <th>Provider Respons</th>
    <th>Transaction Reference</th>
  </tr>
  
  <tr>
    <td>4-13-20190611</td>
    <td>HelaPay</td>
    <td>Jun12, 2019</td>
    <td>$4,579.00</td>
    <td>$4,579.00</td>
    <td>Jul 02, 2019</td>
    <td class="draft"><span>Draft</span></td>
    
  </tr>
  
  <tr>
    <td>4-13-20190611</td>
    <td>OnetwoCo</td>
    <td>Jun12, 2019</td>
    <td>$4,579.00</td>
    <td>$4,579.00</td>
    <td>Jul 02, 2019</td>
    <td class="sent"><span>Sent</span></td>
    
  </tr>
  
  <tr>
    <td>4-13-20190611</td>
    <td>Avbee Pvt Ltd</td>
    <td>Jun12, 2019</td>
    <td>$4,579.00</td>
    <td>$4,579.00</td>
    <td>Jul 02, 2019</td>
    <td class="paid"><span>Paid</span></td>
    
  </tr>
  
  <tr>
    <td>4-13-20190611</td>
    <td>TopTen System</td>
    <td>Jun12, 2019</td>
    <td>$4,579.00</td>
    <td>$4,579.00</td>
    <td>Jul 02, 2019</td>
    <td class="sent"><span>Sent</span></td>
    
  </tr>
  
</table>

    </table>
</div>



</div>
